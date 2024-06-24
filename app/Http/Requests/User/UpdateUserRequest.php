<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // يتم التحقق من الصلاحيات في خطوة التحديث بدلاً من هنا
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
        ];
    }
}
