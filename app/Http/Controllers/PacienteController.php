<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::withCount('consultas')
            ->orderBy('nome')
            ->get();

        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|max:100',
            'telefone' => 'required|max:20',
            'email'    => 'required|email|max:100|unique:pacientes,email',
        ], [
            'nome.required'     => 'O nome é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'email.unique'      => 'Este e-mail já está cadastrado.',
        ]);

        Paciente::create($request->only('nome', 'telefone', 'email'));

        return redirect()->route('pacientes.index')
            ->with('sucesso', 'Paciente cadastrado com sucesso!');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')
            ->with('sucesso', 'Paciente removido com sucesso!');
    }
}
