<?php

namespace App\Http\Requests\Blog\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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
//        dd($this->tag);
        return [
            'title' => [
                'required','string',
                (function () {
                    if(empty($this->tag))
                        return Rule::unique('tags');

                    Rule::unique('tags')->ignore($this->tag->id, 'id');
                })()
            ],
        ];
    }

    protected function failedValidation($validator)
    {
        Session::flash('fail', 'Check fields for correct values.');
//        Session::flash('response_time', time());
    }
}
