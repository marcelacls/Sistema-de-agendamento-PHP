@extends('layouts.app')
@section('title', 'Agendar Consulta')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Nova Consulta</h1>
        <p class="page-sub">Preencha os dados para agendar</p>
    </div>
    <a href="{{ route('consultas.index') }}" class="btn btn-ghost">Voltar</a>
</div>

<div class="form-outer">
    <div class="form-card">
        <p class="form-section-title">Dados da Consulta</p>

        <form action="{{ route('consultas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="paciente_id">Paciente *</label>
                <select id="paciente_id" name="paciente_id"
                        class="{{ $errors->has('paciente_id') ? 'input-erro' : '' }}" required>
                    <option value="">Selecione o paciente</option>
                    @foreach($pacientes as $p)
                        <option value="{{ $p->id }}" {{ old('paciente_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="dentista_id">Dentista *</label>
                <select id="dentista_id" name="dentista_id"
                        class="{{ $errors->has('dentista_id') ? 'input-erro' : '' }}" required>
                    <option value="">Selecione o dentista</option>
                    @foreach($dentistas as $d)
                        <option value="{{ $d->id }}" {{ old('dentista_id') == $d->id ? 'selected' : '' }}>
                            {{ $d->nome }} — {{ $d->especialidade }}
                        </option>
                    @endforeach
                </select>
                <span class="form-help">Cada dentista só pode ter uma consulta por horário.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="data">Data *</label>
                    <input type="date" id="data" name="data"
                           value="{{ old('data') }}" min="{{ date('Y-m-d') }}"
                           class="{{ $errors->has('data') ? 'input-erro' : '' }}" required>
                </div>
                <div class="form-group">
                    <label for="hora">Horário *</label>
                    <input type="time" id="hora" name="hora"
                           value="{{ old('hora') }}"
                           class="{{ $errors->has('hora') ? 'input-erro' : '' }}" required>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Agendar Consulta</button>
                <a href="{{ route('consultas.index') }}" class="btn btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>

    <div class="side-card">
        <p class="side-card-title">Informações</p>
        <ul class="side-list">
            <li>
                <span class="pill">Data</span>
                Não é possível agendar datas no passado.
            </li>
            <li>
                <span class="pill">Conflito</span>
                O sistema verifica automaticamente se o dentista já tem consulta no mesmo horário.
            </li>
            <li>
                <span class="pill">Status</span>
                A consulta começa como Pendente e pode ser confirmada depois.
            </li>
            <li>
                <span class="pill">Paciente</span>
                Caso o paciente não esteja na lista,
                <a href="{{ route('pacientes.create') }}" style="color:var(--teal-100);">cadastre primeiro</a>.
            </li>
        </ul>
    </div>
</div>
@endsection
