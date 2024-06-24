<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'descrption' => 'required',
            'img_url' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required',
            'video' => 'required|file|mimetypes:video/mp4',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'descrption.required' => 'The description field is required.',
            'img_url.required' => 'The image field is required.',
            'img_url.mimes' => 'The image must be a file of type: jpg, png, jpeg, gif, svg.',
            'img_url.max' => 'The image may not be greater than 2048 kilobytes.',
            'category_id.required' => 'The category field is required.',
            'video.required' => 'The video field is required.',
            'video.mimetypes' => 'The video must be a file of type: mp4.',
        ];
    }
}
