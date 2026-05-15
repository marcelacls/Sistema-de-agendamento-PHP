<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('dentista_id')->constrained('dentistas')->onDelete('cascade');
            $table->date('data');
            $table->time('hora');
            $table->enum('status', ['pendente', 'confirmada', 'cancelada'])->default('pendente');
            $table->timestamps();

            // Impede duplo agendamento ativo para o mesmo dentista no mesmo horário
            // (o conflito real é verificado no controller excluindo canceladas)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
