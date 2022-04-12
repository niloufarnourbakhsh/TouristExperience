<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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
            'city'=>'required',
            'title'=>'required',
            'body'=>'required',
            'food' => '',
            'sightseeing' => '',
            'file' => ''
        ];
    }

    public function messages()
    {
        return[
            'city.required'=>'وارد کردن نام شهر ضروری است ',
            'title.required'=>'عنوان مورد نظر را وارد کنید',
            'body.required'=>'مطلبی در مورد مکان بازدید شده بنویسید'
        ];
    }
}
