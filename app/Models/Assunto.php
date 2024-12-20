<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assunto extends Model
{
    use HasFactory;

    protected $table = 'Assunto';
    public $timestamps = false;
    protected $primaryKey = 'codAs';

    protected $fillable = ['Descricao'];

    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(
            Livro::class,
            'Livro_Assunto',
            'Assunto_CodAs',
            'Livro_Codl',
        );
    }

}
