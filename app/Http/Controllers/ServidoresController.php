<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServidoresController extends Controller
{
    public function index()
    {
        return view('backend.pages.server.create');
    }

    public function store(Request $request)
    {

        $messages = [
            'hostname.required' => 'Erro ao enviar dados verifique o campo hostname',
            'tipoServico.required' => 'Erro ao enviar dados verifique o campos tipo de serviço',
            'ipv4.required' => 'Erro ao enviar dados verifique o campos endereço IPV4',
            'linkSaida.required' => 'Erro ao enviar dados verifique o campos link de saída',
            'qtdMemoria.required' => 'Erro ao enviar dados verifique o campos quantidade de memória',
            'sisOperacional.required' => 'Erro ao enviar dados verifique o campos sistema operacional',
            'vinculoLicenca.required' => 'Erro ao enviar dados verifique o campos vinculo de lincença sistema operacional',
        ];

        $request->validate([

            'filename' => '',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hostname' => 'required',
            'tipoServico' => 'required',
            'ipv4' => 'required',
            'linkSaida' => 'required',
            'qtdMemoria' => 'required',
            'sisOperacional' => 'required',
            'vinculoLicenca' => 'required',
            'tags_hd_primario' => '',
            'tags_hd_secundario' => '',
            'programasInstalados' => '',
            'sistemasQs' => ''

        ], $messages);

        if ($request->hasfile('filename')) {

            foreach ($request->file('filename') as $image) {
                $name = date('YmdHis') . $image->getClientOriginalName();
                $image->move(public_path() . '/images/servidores', $name);
                $data[] = $name;
            }

        $form = new Servers();
        $form->filename = json_encode($data);
        $form->hostname = $request->hostname;
        $form->tipoServico = $request->tipoServico;
        $form->ipv4 =  $request->ipv4;
        $form->linkSaida =  $request->linkSaida;
        $form->qtdMemoria =  $request->qtdMemoria;
        $form->sisOperacional =  $request->sisOperacional;
        $form->vinculoLicenca =  $request->vinculoLicenca;
        $form->tags_hd_primario = $request->tags_hd_primario;
        $form->tags_hd_secundario = $request->tags_hd_secundario;
        $form->programasInstalados =  $request->tags_programas;
        $form->sistemasQs =  $request->tags_qsistemas;
        $form->user_id = auth()->user()->id;
        }

        $form = new Servers();
        $form->hostname = $request->hostname;
        $form->tipoServico = $request->tipoServico;
        $form->ipv4 =  $request->ipv4;
        $form->linkSaida =  $request->linkSaida;
        $form->qtdMemoria =  $request->qtdMemoria;
        $form->sisOperacional =  $request->sisOperacional;
        $form->vinculoLicenca =  $request->vinculoLicenca;
        $form->tags_hd_primario = $request->tags_hd_primario;
        $form->tags_hd_secundario = $request->tags_hd_secundario;
        $form->programasInstalados =  $request->tags_programas;
        $form->sistemasQs =  $request->tags_qsistemas;
        $form->user_id = auth()->user()->id;

        $form->save();

        alert()->success('Servidor cadastrado com sucesso');

        return back();
    }
    public function ajaxServer()
    {
        $sac = DB::connection('sac')->select('SELECT ip, label, server_sac_id FROM psm_servers');
        return json_encode($sac);
    }
    public function show()
    {
        $server = DB::table('servers')
            ->paginate(15);

        return view('backend.pages.server.index', [
            'server' => $server,
        ]);
    }
}
