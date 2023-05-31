<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            //
            'title' => 'required|min:5',
            'city' => 'required',
            'body' => 'required',
            'file' => 'required',
            'food' => '',
            'sightseeing' => ''
        ];
    }

    public function messages(): array
    {
        return[
            'title.required'=>'یک عنوان انتخاب کنید',
            'city.required'=>'وارد کردن نام شهر ضروری است',
            'body.required'=>'مطلبی در مورد مکان بازدید شده بنویسید',
            'file.required'=>'حداقل یه عکس آپلود کنید',

        ];
    }
}
