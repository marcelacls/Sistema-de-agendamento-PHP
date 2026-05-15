<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    protected $fillable = ['nome', 'telefone', 'email'];

    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class);
    }
}
