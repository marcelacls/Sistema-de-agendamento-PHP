<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Dentista;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with(['paciente', 'dentista'])
            ->orderBy('data')
            ->orderBy('hora')
            ->paginate(15);

        return view('consultas.index', compact('consultas'));
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('nome')->get();
        $dentistas = Dentista::orderBy('nome')->get();
        return view('consultas.create', compact('pacientes', 'dentistas'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'dentista_id' => 'required|exists:dentistas,id',
            'data'        => 'required|date|after_or_equal:today',
            'hora'        => 'required',
        ], [
            'paciente_id.required' => 'Selecione um paciente.',
            'paciente_id.exists'   => 'Paciente inválido.',
            'dentista_id.required' => 'Selecione um dentista.',
            'dentista_id.exists'   => 'Dentista inválido.',
            'data.required'        => 'A data é obrigatória.',
            'data.after_or_equal'  => 'A data não pode ser no passado.',
            'hora.required'        => 'O horário é obrigatório.',
        ]);

        // Verificar conflito: mesmo dentista, mesma data, mesmo horário (não cancelada)
        $conflito = Consulta::where('dentista_id', $dados['dentista_id'])
            ->where('data', $dados['data'])
            ->where('hora', $dados['hora'])
            ->where('status', '!=', 'cancelada')
            ->first();

        if ($conflito) {
            $dentista = Dentista::find($dados['dentista_id']);
            return back()->withInput()->withErrors([
                'hora' => "Conflito de horário! {$dentista->nome} já tem a consulta #{$conflito->id} "
                        . "agendada para {$conflito->data->format('d/m/Y')} às "
                        . \Carbon\Carbon::parse($conflito->hora)->format('H:i') . ".",
            ]);
        }

        $dados['status'] = 'pendente';
        Consulta::create($dados);

        return redirect()->route('consultas.index')
            ->with('sucesso', 'Consulta agendada com sucesso!');
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->delete();
        return redirect()->route('consultas.index')
            ->with('sucesso', 'Consulta excluída com sucesso!');
    }

    /**
     * Confirma a consulta (pendente → confirmada).
     */
    public function confirmar(Consulta $consulta)
    {
        if ($consulta->confirmar()) {
            return back()->with('sucesso', "Consulta #{$consulta->id} confirmada com sucesso.");
        }
        return back()->with('erro', "Não foi possível confirmar a consulta #{$consulta->id} (status: {$consulta->status}).");
    }

    /**
     * Cancela a consulta.
     */
    public function cancelar(Consulta $consulta)
    {
        $consulta->cancelar();
        return back()->with('sucesso', "Consulta #{$consulta->id} cancelada.");
    }
}
