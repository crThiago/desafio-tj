<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'Livro';
    public $timestamps = false;
    protected $primaryKey = 'Codl';

    protected $fillable = ['Titulo', 'Editora', 'AnoPublicacao', 'Valor'];

    protected $with = ['autores', 'assuntos'];

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(
            Autor::class,
            'Livro_Autor',
            'Livro_Codl',
            'Autor_CodAu'
        );
    }

    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(
            Assunto::class,
            'Livro_Assunto',
            'Livro_Codl',
            'Assunto_CodAs'
        );
    }

}
