<?php

namespace App\Http\Requests\Blog\Post;

use Illuminate\Foundation\Http\FormRequest;

//class UpdateRequest extends FormRequest
class UpdateRequest extends StoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return true;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->isMethod('put')){
            return array_merge(parent::rules(), [
                'file_touched' => ['boolean','nullable'],
            ]);
//            return [
//                'title' => ['required','string'],
//                'seo_title' => ['required','string'],
//                'seo_description' => ['required','string'],
//                'seo_keywords' => ['required','string'],
//                'text' => ['required','string'],
//                'categories' => ['array'],
//                'top' => ['required','boolean'],
//                'file' => ['file','nullable'],
//                'file_alt' => ['required_with:file','string','nullable'],
//                'file_touched' => ['boolean','nullable'],
//
//                'title' => ['required','string','min:5'],
//                'seo_title' => ['required','string'],
//                'seo_description' => ['required','string'],
//                'seo_keywords' => ['required','string'],
//                'description' => ['required','string','max:200','min:5'],
//                'text' => ['required','string','min:5'],
//                'top' => ['required','boolean'],
//                'categories' => ['array','nullable'],
//                'file' => ['file','nullable'],
//                'file_alt' => ['required_with:file','string','nullable'],
//                'file_touched' => ['boolean','nullable'],
//            ];
        }else{
            return [
                'top' => ['boolean'],
            ];
        }
    }
}
