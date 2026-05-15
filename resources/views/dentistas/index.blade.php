@extends('layouts.app')
@section('title', 'Dentistas')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title"> Dentistas</h1>
        <p class="page-sub">Profissionais cadastrados na clínica</p>
    </div>
    <a href="{{ route('dentistas.create') }}" class="btn btn-primary">+ Novo Dentista</a>
</div>

@if($dentistas->isEmpty())
    <div class="empty-state">
        <span class="empty-state-icon"></span>
        <p>Nenhum dentista cadastrado ainda.</p>
    </div>
@else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>Consultas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dentistas as $dentista)
                <tr>
                    <td>{{ $dentista->id }}</td>
                    <td><strong>{{ $dentista->nome }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ $dentista->especialidade }}</span>
                    </td>
                    <td>
                        <span class="badge badge-info">
                            {{ $dentista->consultas_count ?? $dentista->consultas->count() }}
                        </span>
                    </td>
                    <td>
                        <div class="td-actions">
                            <form action="{{ route('dentistas.destroy', $dentista) }}" method="POST"
                                  onsubmit="return confirm('Remover o dentista {{ $dentista->nome }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
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
