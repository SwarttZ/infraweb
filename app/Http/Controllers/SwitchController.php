<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Switchs;
use Illuminate\Support\Facades\DB;

class SwitchController extends Controller
{
    public function index()
    {
        return view('backend.pages.switch.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'fabricante.required' => 'Porfavor verifique o campo fabricante',
            'numeroSerie.required' => 'Porfavor verifique o campo n° serie',
            'qtdPortas.required' => 'Porfavor verifique o campo quantidade de portas',
            'localizacao.required' => 'Porfavor verifique o campo localização',
        ];

        $request->validate([
            'fabricante' => 'required',
            'numeroSerie' => 'required',
            'qtdPortas' => 'required',
            'localizacao' => 'required',
            'observacoes', 'max: 100',
        ], $messages);

        Switchs::create([
            'fabricante' => $request->fabricante,
            'serial' => $request->numeroSerie,
            'qtdPortas' => $request->qtdPortas,
            'localizacao' => $request->localizacao,
            'observacoes' => $request->observacoes,
            'user_id' => auth()->user()->id
        ]);

        alert()->success('Switch/Roteador cadastrado com sucesso');

        return back();
    }
    public function show()
    {
        $router = DB::table('switchs')
            ->paginate(15);

        return view('backend.pages.switch.index', [
            'router' => $router,
        ]);
    }
}
