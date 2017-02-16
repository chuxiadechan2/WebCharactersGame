<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegFunctionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required|min:6|max:16',
            'passwd' => 'required|min:6|max:16|confirmed',
            'passwd_confirmation' => 'required|min:6|max:16',
            'email' => 'required|email',
        ];
    }

    /**
    * 验证错误信息提示自定义
    */
    public function messages()
    {
        return [
            'account.required' => 'Error:账号不能为空,请重试.',
            'account.min' => 'Error:账号最小位数不能少于:min位.',
            'account.max' => 'Error:账号最大位数不能大于:max位.',
            'passwd.required' => 'Error:密码不能为空,请重试.',
            'passwd.min' => 'Error:密码最小位数不能少于:min位.',
            'passwd.max' => 'Error:密码最大位数不能大于:max位.',
            'passwd.confirmed' => 'Error:两次密码输入不一致,请重试.',
            'passwd_confirmation.required' => 'Error:确认密码不能为空,请重试.',
            'passwd_confirmation.min' => 'Error:确认密码位数不能少于:min位',
            'passwd_confirmation.max' => 'Error:确认密码位数不能多于:max位',
            'email.required' => 'Error:邮箱不能为空,请重试.',
            'email.email' => 'Error:邮箱格式不正确,请重试.',
        ];
    }
}
