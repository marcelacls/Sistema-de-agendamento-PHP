@extends('layouts.app')
@section('title', 'Novo Paciente')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Novo Paciente</h1>
        <p class="page-sub">Cadastre um novo paciente na clínica</p>
    </div>
    <a href="{{ route('pacientes.index') }}" class="btn btn-ghost">Voltar</a>
</div>

<div class="form-outer">
    <div class="form-card">
        <p class="form-section-title">Dados do Paciente</p>

        <form action="{{ route('pacientes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome completo *</label>
                <input type="text" id="nome" name="nome"
                       value="{{ old('nome') }}" placeholder="Nome completo"
                       class="{{ $errors->has('nome') ? 'input-erro' : '' }}" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone *</label>
                <input type="text" id="telefone" name="telefone"
                       value="{{ old('telefone') }}" placeholder="Telefone com DDD"
                       class="{{ $errors->has('telefone') ? 'input-erro' : '' }}" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail *</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" placeholder="E-mail do paciente"
                       class="{{ $errors->has('email') ? 'input-erro' : '' }}" required>
                <span class="form-help">O e-mail deve ser único no sistema.</span>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>
                <a href="{{ route('pacientes.index') }}" class="btn btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="side-card">
        <p class="side-card-title">Sobre o cadastro</p>
        <ul class="side-list">
            <li>
                <span class="pill">E-mail</span>
                Cada paciente deve ter um e-mail único no sistema.
            </li>
            <li>
                <span class="pill">Consultas</span>
                Após cadastrar o paciente, você poderá agendar consultas para ele.
            </li>
            <li>
                <span class="pill">Atenção</span>
                Remover um paciente também remove todas as suas consultas.
            </li>
        </ul>
    </div>
</div>
@endsection
