@extends('layouts.app')
@section('title', 'Novo Dentista')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Novo Dentista</h1>
        <p class="page-sub">Cadastre um novo profissional na clínica</p>
    </div>
    <a href="{{ route('dentistas.index') }}" class="btn btn-ghost">Voltar</a>
</div>

<div class="form-outer">
    <div class="form-card">
        <p class="form-section-title">Dados do Profissional</p>

        <form action="{{ route('dentistas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome completo *</label>
                <input type="text" id="nome" name="nome"
                       value="{{ old('nome') }}" placeholder="Nome completo do profissional"
                       class="{{ $errors->has('nome') ? 'input-erro' : '' }}" required>
            </div>

            <div class="form-group">
                <label for="especialidade">Especialidade *</label>
                <select id="especialidade" name="especialidade"
                        class="{{ $errors->has('especialidade') ? 'input-erro' : '' }}" required>
                    <option value="">Selecione a especialidade</option>
                    @php
                        $especialidades = [
                            'Clínico Geral','Ortodontia','Periodontia','Endodontia',
                            'Implantodontia','Odontopediatria','Cirurgia Bucomaxilofacial',
                            'Prótese Dentária','Estética Dental','Radiologia'
                        ];
                    @endphp
                    @foreach($especialidades as $e)
                        <option value="{{ $e }}" {{ old('especialidade') === $e ? 'selected' : '' }}>
                            {{ $e }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Cadastrar Dentista</button>
                <a href="{{ route('dentistas.index') }}" class="btn btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="side-card">
        <p class="side-card-title">Sobre o cadastro</p>
        <ul class="side-list">
            <li>
                <span class="pill">Agenda</span>
                O sistema impede duplo agendamento para o mesmo dentista no mesmo horário.
            </li>
            <li>
                <span class="pill">Atenção</span>
                Remover um dentista também cancela todas as suas consultas associadas.
            </li>
        </ul>
    </div>
</div>
@endsection
