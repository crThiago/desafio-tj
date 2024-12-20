<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
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
            'Titulo' => 'required|string|max:40',
            'Editora' => 'required|string|max:40',
            'AnoPublicacao' => 'required|string|size:4',
            'Valor' => 'required|numeric|min:0',
            'Autores' => 'nullable|array|exists:Autor,CodAu',
            'Assuntos' => 'nullable|array|exists:Assunto,codAs',
        ];
    }

    public function attributes()
    {
        return [
            'Titulo' => 'Título',
            'Editora' => 'Editora',
            'AnoPublicacao' => 'Ano de publicação',
            'Valor' => 'Valor',
            'Autores' => 'Autores',
            'Assuntos' => 'Assuntos',
        ];
    }
}
