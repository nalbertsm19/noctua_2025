<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocenteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email|max:100',
            'formacao' => 'required|string',
            'disponibilidade' => 'required|integer',
            'suap' => 'required|integer',
            'descricao' => 'required|string',
            'curriculo_lates' => 'required|string|max:255',
            'foto_perfil' => 'nullable|image|max:2048', 
        ];
    }


    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.unique' => 'O email já está em uso.',
            'email.max' => 'O email deve ter no máximo 100 caracteres.',
            'formacao.required' => 'A formação acadêmica é obrigatória.',
            'disponibilidade.required' => 'A disponibilidade é obrigatória.',
            'disponibilidade.integer' => 'A disponibilidade deve ser um número inteiro.',
            'suap.required' => 'O campo SUAP é obrigatório.',
            'suap.integer' => 'O campo SUAP deve ser um número inteiro.',
            'descricao.required' => 'A descrição é obrigatória.',
            'curriculo_lates.required' => 'O link do Currículo Lattes é obrigatório.',
            'curriculo_lates.max' => 'O link do Currículo Lattes deve ter no máximo 255 caracteres.',
            'foto_perfil.image' => 'A foto de perfil deve ser uma imagem válida.',
            'foto_perfil.max' => 'A foto de perfil não deve exceder 2048 KB.',
        ];
    }

}
