<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; # false / true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'ficheiro_foto' => 'bail|required|image|mimes:jpeg,png,jpg|max:4000' # 4000KB = 4MB
        ];
    }

    /**
     * Get the messages array.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        return [
            'ficheiro_foto.required' => 'Selecione um arquivo',
            'ficheiro_foto.image' => 'O arquivo deve ser uma imagem',
            'ficheiro_foto.mimes' => 'A imagem deve ser (jpeg, png, jpg)',
            'ficheiro_foto.max' => 'A imagem deve ter no máximo 4MB'
        ];
    }
}
