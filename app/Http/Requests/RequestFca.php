<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class RequestFca extends FormRequest
    {


        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, mixed>
         */
        public function rules()
        {
            return [
                'fcaNumber' => 'bail|required|alpha_num|digits_between:4,20'
            ];
        }
    }
