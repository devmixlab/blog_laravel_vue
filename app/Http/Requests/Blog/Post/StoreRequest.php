<?php

namespace App\Http\Requests\Blog\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','min:5'],
            'seo_title' => ['required','string'],
            'seo_description' => ['required','string'],
            'seo_keywords' => ['required','string'],
            'description' => ['required','string','max:200','min:5'],
            'text' => ['required','string','min:5'],
            'top' => ['required','boolean'],
            'categories' => ['array','nullable'],
            'file' => ['file','nullable'],
            'file_alt' => ['required_with:file','string','nullable'],
        ];
    }

    protected function failedValidation($validator)
    {
        Session::flash('fail', 'Check fields for correct values.');
//        Session::flash('response_time', time());


//        dd(333);
//        $result = '';
//
//        foreach( $validator->messages()->toArray() as $message ) {
//            $result .= implode( ' ', $message ).' ';
//        }
////        throw ValidationException::withMessages([
////            'error' => 'Check all fields for correct values'
////        ]);
//
//        throw ValidationException::withMessages([
//            'unique_message' => $result
//        ]);


    }
}
