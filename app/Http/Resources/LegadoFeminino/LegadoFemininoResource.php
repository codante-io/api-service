<?php

namespace App\Http\Resources\LegadoFeminino;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LegadoFemininoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'ano_nascimento' => $this->ano_nascimento,
            'ano_morte' => $this->ano_morte,
            'contribuicao' => $this->contribuicao,
        ];
    }
}
    