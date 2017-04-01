<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginArtisanRequest extends FormRequest
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
            'username' => 'required|max:16|min:6',
            'passwd' => 'required|max:16|min:6'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名不能为空.',
            'username.min' => '用户名长度不能低于:min位',
            'username.max' => '用户名长度不能多于:max位',
            'passwd.required' => '密码不能为空',
            'passwd.min' => '密码长度不能低于:min位',
            'passwd.max' => '密码长度不能高于:max位',
        ];
    }
}
