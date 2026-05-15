<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consulta extends Model
{
    public const STATUS = ['pendente', 'confirmada', 'cancelada'];

    protected $fillable = ['paciente_id', 'dentista_id', 'data', 'hora', 'status'];

    protected $casts = [
        'data' => 'date',
    ];

    protected $attributes = [
        'status' => 'pendente',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function dentista(): BelongsTo
    {
        return $this->belongsTo(Dentista::class);
    }

    public function confirmar(): bool
    {
        if ($this->status === 'pendente') {
            $this->update(['status' => 'confirmada']);
            return true;
        }
        return false;
    }

    public function cancelar(): void
    {
        if ($this->status !== 'cancelada') {
            $this->update(['status' => 'cancelada']);
        }
    }
}
