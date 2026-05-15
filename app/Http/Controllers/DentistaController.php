<?php

namespace App\Http\Controllers;

use App\Models\Dentista;
use Illuminate\Http\Request;

class DentistaController extends Controller
{
    public function index()
    {
        $dentistas = Dentista::withCount('consultas')
            ->orderBy('nome')
            ->get();

        return view('dentistas.index', compact('dentistas'));
    }

    public function create()
    {
        return view('dentistas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'          => 'required|max:100',
            'especialidade' => 'required|max:100',
        ], [
            'nome.required'          => 'O nome é obrigatório.',
            'especialidade.required' => 'A especialidade é obrigatória.',
        ]);

        Dentista::create($request->only('nome', 'especialidade'));

        return redirect()->route('dentistas.index')
            ->with('sucesso', 'Dentista cadastrado com sucesso!');
    }

    public function destroy(Dentista $dentista)
    {
        $dentista->delete();
        return redirect()->route('dentistas.index')
            ->with('sucesso', 'Dentista removido com sucesso!');
    }
}
