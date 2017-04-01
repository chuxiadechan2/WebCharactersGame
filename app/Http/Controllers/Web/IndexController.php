<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\LoginArtisanRequest;
use App\Http\Requests\RegFunctionRequest;
use App\Jobs\SendVerifyEmailJob;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class IndexController extends Controller
{
    public function __construct()
    {
        return view() -> share('configData',DB ::table( 'config' ) -> pluck( 'value', 'key' ));
    }

    /**
     * 判断用户是否登录,不知道什么原因__construct不能使用laravel的session了
     *
     * @param Request $session session管理的类
     *
     * @param int $type 操作类型,1为判断是否登录,2为获取用户信息
     *
     * @param string||array $name 如果$type为2时,获取信息都名字
     *
     * @return boolean
     *
     * @author 初夏的蝉︵°
     *
     * @license null
     */
    private function is_login(Request $session,$type=1,$name='')
    {
        switch ($type){
            case 1:
                return $session -> session() -> has('is_login') && $session -> session() ->get('is_login') == 'true';
            break;
            case 2:
                if (!empty($name)){
                    //判断是否为数组,如果为数组就遍历数组
                    if(is_array($name)){
                        $returnData = [];
                        foreach($name as $val){
                            $returnData[$val] = $session -> session() -> get($val);
                        }
                    }else{
                        $returnData[$name] = $session -> session() -> get($name);
                    }
                    return $returnData;
                }else{
                    return '变量名不能为空.';
                }
        }
    }

    public function Index( Request $session)
    {
         if(!$this->is_login($session,1)){
            return redirect(asset('/login.html'));
         }

        //获取网站的相关配置
        $configData = DB::table( 'config' ) -> pluck( 'value', 'key' );
        $config = [];
        
        foreach($configData as $key=>$val){
            $config[$key] = $val;
        }

        //获取服务器区组
        $serverGroup = DB::table('servergroup') -> get();

        //输出变量
        return view('Web.index',[
            'configData' => $config,
            'serverGroup' => $serverGroup,
        ]);
    }

    public function joinGame(Request $session,$serverId)
    {
        //判断用户是否登录
        if(!$session -> session() -> has('is_login') || $session -> session() -> get('is_login') !== true){
            return redirect('login.html');
        }

        //首先查询服务器是否存在
        $is_yes = DB::table('servergroup') -> where('id', $serverId) -> first();

        //如果服务器区组不存在,则跳转404错误
        if(empty($is_yes)){
           return view('Error.404');
        }

        //如果服务器群组存在的话,就查看是否存在角色
        $is_role = DB::table('userinfo') -> where('id','id') -> get();
    }

    /**
     * 显示用户登录页面
     *
     * @return null
     *
     * @author 初夏的蝉︵°
     *
     */
    public function loginView(Request $request)
    {
        //判断是否登录
        if($this->is_login($request,1)){
            return redirect('/');
        }
        $configData = DB ::table( 'config' ) -> where('key','web_title') -> pluck( 'value', 'key' );
        return view('Web.Login',[
            'configData' => $configData,
        ]);
    }

    /**
     * 用户登录的函数,目前进行简单验证
     *
     * @author 初夏的蝉︵°
     */
    public function loginFunction(LoginArtisanRequest $loginData)
    {

        //获取准备登录的用户数据,用来判断是否存在
        $userExists = DB::table('account') -> where('account',$loginData -> get('username')) -> first();

        //判断准备登录的用户是否存在
        if(!$userExists){
            return redirect('login.html') -> withErrors(['用户名不存在']);
        }

        //如果存在,开始判断用户密码是否正确
        $postUserPasswd = md5($loginData -> get('passwd'));
        $libUserPasswd = md5(decrypt($userExists -> passwd));

        //判断用户密码是否正确
        if($postUserPasswd !== $libUserPasswd){
            return redirect('login.html') -> withErrors(['用户名或密码错误.']);
        }

        //判断用户是否被封号
        if($userExists -> state === 2){
            return redirect( 'login.html' ) -> withErrors( [ '该账号已被封锁,无法继续登录.' ] );
        }

        //判断用户是否激活邮箱
        if($userExists -> state === 3){
            return redirect( 'login.html' ) -> withErrors( [ '该帐号尚未激活邮箱,请激活再尝试登录.' ] );
        }

        //修改用户最后登录时间
        $is_success = DB::table('account') -> where('id',$userExists -> id) -> update([
            'login_time_at' => $userExists -> login_time,
            'login_time' => Carbon::now(),
        ]);

        //做最后都处理
        if($is_success){
            //所有验证已经完成,开始存储session
            $loginData -> session() -> put('is_login',true);
            $loginData -> session() -> put( 'id', $userExists -> id );
            $loginData -> session() -> put( 'account', $userExists -> account );
            return redirect('/');
        }else{
            return rediect('login.html') -> withErrors('服务器繁忙,请稍候再试.');
        }
    }

    /**
     * 用户退出登录的方法
     *
     */
    public function outLogin(Request $session)
    {
        //判断用户是否登录
        if(!$this->is_login($session,1)){
            return redirect('login.html');
        }

        //设置用户退出登录时间
        $is_success = DB::table('account') -> where('id',$session -> session() -> get('id')) -> update([
            'loginout_time' => Carbon::now(),
        ]);

        //进行退出登录操作
        if($is_success){
            $session -> session() -> flush();
            return redirect('login.html');
        }
    }

    /**
     * 用户注册账号的方法
     *
     */
    public function regView()
    {
        return view('Web.Reg');
    }

    /**
    * 用户进行注册的方法
    */
    public function regFunction(RegFunctionRequest $request)
    {

        $key = encrypt( $request -> get( 'account' ) );
        DB::table('account') -> insert([
            'account' => $request -> get('account'),
            'passwd' => encrypt($request -> get('passwd')),
            'email' => $request -> get('email'),
            'reg_time' => Carbon::now(),
            'login_time' => Carbon ::now(),
            'login_time_at' => Carbon ::now(),
            'loginout_time' => Carbon ::now(),
            'key' => $key,
        ]);

        //开始准备发送邮件
        $emailSendData = [
            'email' => $request -> get('email'),
            'title' => (DB ::table( 'config' ) -> pluck( 'value', 'key' ))['web_title'],
            'username' => $request -> get('account'),
            'verifyUrl' => $key,
        ];

        $job = (new SendVerifyEmailJob( $emailSendData )) -> onQueue('emails');

        dispatch($job);
        //$this -> dispatch(new SendVerifyEmailJob($emailSendData));
        return redirect('login.html');
    }

    /**
    * 验证用户邮箱操作
    */
    public function verifyEmail($verifyKey = null)
    {
        //判断是否非法操作
        if(empty($verifyKey)){
            return view('Error.404');
        }

        //开始设置进行激活操作
        $account = decrypt($verifyKey);

        $is_success = DB::table('account') -> where([
            ['account','=',$account],
            ['key','=',$verifyKey],
            ['state','=','3']
        ]) -> update([
            'key' => 'success!',
            'state' => 1,
        ]);
        if($is_success){
            return redirect('login.html') -> withErrors(['邮箱已经成功激活.']);
        }else{
            return redirect('login.html') -> withErrors(['邮箱已被激活或是激活链接非法.']);
        }
    }
}
