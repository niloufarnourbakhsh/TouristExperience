<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'body' => 'required',
            'email' => 'required|email',
        ];

    }

    public function messages(): array
    {
        return [
            'name.required'=> 'لطفا نام خود را وارد کنید',
            'email.required'=> 'لطفا ایمیل خود را وارد کنید',
            'body.required'=> 'لطفا پیام خود را وارد کنید'
        ];
    }
}
