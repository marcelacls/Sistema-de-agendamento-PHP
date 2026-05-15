@extends('layouts.app')
@section('title', 'Clínica Dentária')

@section('content')
<div class="home-hero">
    <h2>Gestão da sua clínica,<br>simples e organizada</h2>
    <p>Gerencie pacientes, dentistas e consultas aqui.</p>

    <div class="cards-home">
        <a href="{{ route('pacientes.index') }}" class="card-home">
            <div class="card-icon-wrap icon-teal"></div>
            <h3>Pacientes</h3>
            <p>Cadastre e visualize todos os pacientes da clínica</p>
            <div class="card-arrow">Ver pacientes</div>
        </a>
        <a href="{{ route('dentistas.index') }}" class="card-home">
            <div class="card-icon-wrap icon-gold"></div>
            <h3>Dentistas</h3>
            <p>Gerencie a equipe de profissionais e especialidades</p>
            <div class="card-arrow">Ver dentistas →</div>
        </a>
        <a href="{{ route('consultas.index') }}" class="card-home">
            <div class="card-icon-wrap icon-mint"></div>
            <h3>Consultas</h3>
            <p>Agende e acompanhe todas as consultas marcadas</p>
            <div class="card-arrow">Ver consultas →</div>
        </a>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <span class="stat-number">{{ \App\Models\Paciente::count() }}</span>
            <span class="stat-label">Pacientes</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">{{ \App\Models\Dentista::count() }}</span>
            <span class="stat-label">Dentistas</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">{{ \App\Models\Consulta::count() }}</span>
            <span class="stat-label">Consultas</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">
                {{ \App\Models\Consulta::where('status', 'confirmada')->count() }}
            </span>
            <span class="stat-label">Confirmadas</span>
        </div>
    </div>
</div>
@endsection
