<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SynonymRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "word" => ['required', 'string', 'max:255'],
            "synonym" => ['required', 'string', 'max:255'],
        ];

        for ($i = 0; $i < count($this->request->get("synonyms")); $i++) {
            $rules["synonyms.".$i] = "string|max:255";
        }

        return $rules;
    }

    public function attributes()
    {
        $attr = [
            'word' => 'Название',
            'synonym' => 'Синоним',
        ];

        for ($i = 0; $i < count($this->request->get("synonyms")); $i++) {
            $attr["synonyms.".$i] = "Синоним №". ($i + 2);
        }

        return $attr;
    }
}
