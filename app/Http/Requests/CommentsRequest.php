<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
            'body'=>'required',
            'post_id'=>'required'
        ];
    }

    public function messages(): array
    {
        return[
            'body.required'=>'برای ارسال نظر خود باید نظر خود را در کادر بالا بنویسید '
        ];
    }
}
