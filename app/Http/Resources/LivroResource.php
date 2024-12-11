<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Codl' => $this->Codl,
            'Titulo' => $this->Titulo,
            'Editora' => $this->Editora,
            'AnoPublicacao' => $this->AnoPublicacao,
            'Valor' => $this->Valor,
            'Autores' => AutorResource::collection($this->autores),
            'Assuntos' => AssuntoResource::collection($this->assuntos),
        ];
    }
}
