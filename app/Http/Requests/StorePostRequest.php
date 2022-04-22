<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            //
            'post_title' => 'required|unique:posts|string:65',
            'body' => 'required',
            'file_name' => 'image|nullable|max:1999'
        ];
    }

    /**
     * Defining Customized messages for
     * the errors (this is optional except in cases where you want a customized message
     * defined by you)
     */
    // public function messages()
    // {
    //     return [
    //         'title.required' => 'The Post Title is required',
    //         'body.required' => 'The Description of the Post is required'
    //     ];
    // }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'post_title' => 'Post Title',
            'body' => 'Description',
            'file_name' => 'File Image'
        ];
    }
}
