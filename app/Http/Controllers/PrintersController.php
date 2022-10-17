<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Printers;
use Illuminate\Support\Facades\DB;

class PrintersController extends Controller
{
    public function index()
    {
        return view('backend.pages.printers.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'fabricante.required' => 'Porfavor verifique o campo fabricante',
            'numeroSerie.required' => 'Porfavor verifique o campo n° serie',
            'tipoCartucho.required' => 'Porfavor verifique o campo tipo cartucho',
            'modeloCartucho.required' => 'Porfavor verifique o campo modelo cartucho',
        ];

        $request->validate([
            'fabricante' => 'required',
            'numeroSerie' => 'required',
            'tipoCartucho' => 'required',
            'modeloCartucho' => 'required',
            'observacoes', 'max: 100',
        ], $messages);

        Printers::create([
            'fabricante' => $request->fabricante,
            'serial' => $request->numeroSerie,
            'tipoCartucho' => $request->tipoCartucho,
            'modeloCartucho' => $request->modeloCartucho,
            'observacoes' => $request->observacoes,
            'user_id' => auth()->user()->id
        ]);

        alert()->success('Impressora cadastrado com sucesso');

        return back();
    }

    public function show()
    {
        $printers = DB::table('printers')
            ->paginate(15);

        return view('backend.pages.printers.index', [
            'printers' => $printers,
        ]);
    }
}
