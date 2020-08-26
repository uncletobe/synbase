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
            "mainWord" => ['required', 'string', 'max:255'],
            "synonyms0" => ['required', 'string', 'max:255'],
        ];

//        for ($i = 0; $i < count($this->request->get("synonyms")); $i++) {
//            $rules["synonyms.".$i] = "string|max:255";
//        }

        return $rules;
    }

    public function attributes()
    {
        $attr = [
            'mainWord' => 'Название',
            'synonyms0' => 'Синоним',
        ];

//        for ($i = 0; $i < count($this->request->get("synonyms")); $i++) {
//            $attr["synonyms.".$i] = "Синоним №". ($i + 2);
//        }

        return $attr;
    }
}
