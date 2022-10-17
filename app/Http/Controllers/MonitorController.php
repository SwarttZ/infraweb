<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitores;
use Illuminate\Support\Facades\DB;

class MonitorController extends Controller
{
    public function index()
    {
        return view('backend.pages.monitor.create');
    }

    public function store(Request $request)
    {

        $messages = [
            'fabricante.required' => 'Porfavor verifique o campo fabricante',
            'numeroSerie.required' => 'Porfavor verifique o campo n° serie',
            'polegadas.required' => 'Porfavor verifique o campo polegadas',
            'observacoes.required' => 'Porfavor verifique o campo observações',
        ];

        $request->validate([
            'fabricante' => 'required',
            'numeroSerie' => 'required',
            'polegadas' => 'required',
            'observacoes', 'max: 100',
        ], $messages);

        Monitores::create([
            'fabricante' => $request->fabricante,
            'serial' => $request->numeroSerie,
            'polegadas' => $request->polegadas,
            'observacoes' => $request->observacoes,
            'user_id' => auth()->user()->id
        ]);

        alert()->success('Monitor cadastrado com sucesso');

        return back();
    }
    public function show()
    {
        $monitors = DB::table('monitores')
            ->paginate(15);

        return view('backend.pages.monitor.index', [
            'monitors' => $monitors,
        ]);
    }
}
