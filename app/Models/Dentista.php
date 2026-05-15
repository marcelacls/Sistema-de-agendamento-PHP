<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dentista extends Model
{
    protected $fillable = ['nome', 'especialidade'];

    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class);
    }
}
