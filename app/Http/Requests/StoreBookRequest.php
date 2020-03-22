<?php

namespace App\Http\Requests;

use App\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreBookRequest extends FormRequest
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
            'title'        => 'required|max:255',
            'author'       => 'required|max:255',
            'published_at' => 'required|date|date_format:Y-m-d',
        ];
    }

    /**
     * After validation hook.
     *
     * @param \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->alreadyExists()) {
                $validator->errors()->add('duplicate', 'Same record already exists.');
            }
        });
    }

    /**
     * Determine if a record with given attributes already exists.
     *
     * @return bool
     */
    public function alreadyExists()
    {
        $attributes = $this->only(['title', 'author', 'published_at']);

        return Book::where($attributes)->exists();
    }
}
