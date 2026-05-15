@extends('layouts.app')
@section('title', 'Consultas Agendadas')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Consultas</h1>
        <p class="page-sub">Agenda de consultas agendadas, confirmadas e canceladas</p>
    </div>
    <a href="{{ route('consultas.create') }}" class="btn btn-primary">+ Agendar Consulta</a>
</div>

@if($consultas->isEmpty())
    <div class="empty-state">
        <span class="empty-state-icon"></span>
        <p>Nenhuma consulta agendada ainda.</p>
    </div>
@else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Paciente</th>
                    <th>Dentista</th>
                    <th>Especialidade</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->id }}</td>
                    <td>{{ $consulta->paciente->nome }}</td>
                    <td>{{ $consulta->dentista->nome }}</td>
                    <td>{{ $consulta->dentista->especialidade }}</td>
                    <td>{{ $consulta->data->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($consulta->hora)->format('H:i') }}</td>
                    <td>
                        @php
                            $s = $consulta->status ?? 'pendente';
                        @endphp
                        <span class="badge badge-{{ $s }}">
                            {{ ucfirst($s) }}
                        </span>
                    </td>
                    <td>
                        <div class="td-actions">
                            @if(($consulta->status ?? 'pendente') === 'pendente')
                                <form action="{{ route('consultas.confirmar', $consulta) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Confirmar</button>
                                </form>
                            @endif

                            @if(($consulta->status ?? 'pendente') !== 'cancelada')
                                <form action="{{ route('consultas.cancelar', $consulta) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-warning btn-sm">Cancelar</button>
                                </form>
                            @endif

                            <form action="{{ route('consultas.destroy', $consulta) }}" method="POST"
                                  onsubmit="return confirm('Excluir esta consulta permanentemente?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(method_exists($consultas, 'links'))
        <div class="pag-wrap">{{ $consultas->links() }}</div>
    @endif
@endif
@endsection
