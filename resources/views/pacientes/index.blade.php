@extends('layouts.app')
@section('title', 'Pacientes')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Pacientes</h1>
        <p class="page-sub">Todos os pacientes cadastrados na clínica</p>
    </div>
    <a href="{{ route('pacientes.create') }}" class="btn btn-primary">+ Novo Paciente</a>
</div>

@if($pacientes->isEmpty())
    <div class="empty-state">
        <span class="empty-state-icon"></span>
        <p>Nenhum paciente cadastrado ainda.</p>
    </div>
@else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Consultas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->id }}</td>
                    <td><strong>{{ $paciente->nome }}</strong></td>
                    <td>{{ $paciente->telefone }}</td>
                    <td>{{ $paciente->email }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{ $paciente->consultas_count ?? $paciente->consultas->count() }}
                        </span>
                    </td>
                    <td>
                        <div class="td-actions">
                            <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST"
                                  onsubmit="return confirm('Remover o paciente {{ $paciente->nome }}? Todas as consultas serão excluídas.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> Remover</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
