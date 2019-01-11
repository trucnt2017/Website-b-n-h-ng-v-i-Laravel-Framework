<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'txtUserName' => 'required|unique:users,name',
            'txtPass' => 'required',
            'txtRePass' => 'required|same:txtPass',
            'txtEmail' => 'required|unique:users,email|regex:/^[a-z][a-z0-9]*(_[a-z0-9]+)*(\.[a-z0-9]+)*@[a-z0-9]([a-z0-9][a-z0-9]+)*(\.[a-z]{2,4}){1,2}$/ '
        ];
    }
    public function messages(){
       return [
        'txtUserName.required'=> "Hãy nhập vào tên thành viên .",
        'txtUserName.unique'=> "Thành viên đã tồn tại .",
        'txtPass.required'=> "Hãy nhập vào mật khẩu . ",
        'txtRePass.required'=> "Hãy nhập vào xác nhận mật khẩu . ",
        'txtRePass.same'=> "Mật khẩu không trùng khớp .",
        'txtEmail.required'=> "Hãy nhập vào email . ",
        'txtEmail.unique'=> "Email đã tồn tại  .",
        'txtEmail.regex'=> "Email không đúng định dạng "
       ];
    }
}
