<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;
use App\Repositories\Repository;
use App\Http\Controllers\ResizeImagemController;
use App\Models\Monitores;
use App\Models\Programas;
use App\Models\ProgramasQuality;

class ComputerController extends Controller
{
    protected $computer;
    protected $monitor;
    protected $programas;
    protected $programasQuality;

    public function __construct(Computer $computer, Monitores $monitor, Programas $programas, ProgramasQuality $programasQuality)
    {
        $this->computer = new Repository($computer);
        $this->monitor = new Repository($monitor);
        $this->programas = new Repository($programas);
        $this->programasQuality = new Repository($programasQuality);
    }
    public function index()
    {
        $programas = $this->programas->getModel()
            ->where('programasInstalados', 'like', '%Pacote Office 365%')
            ->get();

        $programasQuality = $this->programasQuality->getModel()
            ->where('programasQuality', 'like', '%Monitor%')
            ->get();

        $monitor = $this->monitor->getModel()
            ->where('fabricante', '!=', 'teste')
            ->orderByRaw('updated_at - created_at DESC')
            ->get();

        return view('backend.pages.computer.create', [
            'programas' => $programas,
            'programasQuality' => $programasQuality,
            'monitor' => $monitor
        ]);
    }
    public function store(Request $request)
    {


        $messages = [
            'hostname.required' => 'Erro ao enviar dados verifique o campo hostname',
            'idteamviewer.required' => 'Erro ao enviar dados verifique o campo teamviewer',
            'setorSelect.required' => 'Erro ao enviar dados verifique o campo setor',
            'nomeUsuario.required' => 'Erro ao enviar dados verifique o campo nome usuário',
            'ipv4.required' => 'Erro ao enviar dados verifique o campo endereço IPV4',
            'linkSaida.required' => 'Erro ao enviar dados verifique o campo endereço IPV4(Externo)',
            'qtdMemoria.required' => 'Erro ao enviar dados verifique o campo quantidade de memória',
            'sisOperacional.required' => 'Erro ao enviar dados verifique o campo sistema operacional',
            'vinculoLicenca.required' => 'Erro ao enviar dados verifique o campo vinculo licença',
            'filename.max' => 'Erro ao enviar imagem formatos permitidos jpeg,png,jpg'
        ];

        $request->validate([

            'filename' => '',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'hostname' => 'required',
            'idteamviewer' => 'required',
            'setorSelect' => 'required',
            'nomeUsuario' => 'required',
            'numeroRemoto' => '',
            'ipv4' => 'required',
            'linkSaida' => 'required',
            'qtdMemoria' => 'required',
            'sisOperacional' => 'required',
            'vinculoLicenca' => 'required',
            'tags_hd_primario' => '',
            'tags_hd_secundario' => '',
            'monitorPrimario' => '',
            'monitorSecundario' => '',
            'ramalTelefone' => '',
            'tags_programas' => '',
            'sistemasQs' => ''

        ], $messages);

        if ($request->hasfile('filename')) {

            foreach ($request->file('filename') as $image) {

                $name = date('YmdHis') . $image->getClientOriginalName();
                $resize = new ResizeImagemController();
                $resize->salvarImagem($image, $name, '/images/computer');

                $data[] = $name;
            }
            $form = new Computer();
            $form->filename = json_encode($data);
            $form->hostname = $request->hostname;
            $form->idteamviewer = $request->idteamviewer;
            $form->setor =  $request->setorSelect;
            $form->nomeUsuario =  $request->nomeUsuario;
            $form->numeroRemoto = $request->numeroRemoto;
            $form->ipv4 =  $request->ipv4;
            $form->linkSaida =  $request->linkSaida;
            $form->qtdMemoria =  $request->qtdMemoria;
            $form->sisOperacional =  $request->sisOperacional;
            $form->vinculoLicenca =  $request->vinculoLicenca;
            $form->tags_hd_primario = 'Primario: ' . $request->tags_hd_primario;
            $form->tags_hd_secundario = 'Secundario: ' . $request->tags_hd_secundario;
            $form->monitor_primario =  $request->monitorPrimario;
            $form->monitor_secundario = $request->monitorSecundario;
            $form->ramalTelefone =  $request->ramalTelefone;
            $form->programasInstalados =  $request->tags_programas;
            $form->sistemasQs =  $request->tags_qsistemas;
            $form->user_id = auth()->user()->id;
        }

        $form = new Computer();
        $form->hostname = $request->hostname;
        $form->idteamviewer = $request->idteamviewer;
        $form->setor =  $request->setorSelect;
        $form->nomeUsuario =  $request->nomeUsuario;
        $form->numeroRemoto = $request->numeroRemoto;
        $form->ipv4 =  $request->ipv4;
        $form->linkSaida =  $request->linkSaida;
        $form->qtdMemoria =  $request->qtdMemoria;
        $form->sisOperacional =  $request->sisOperacional;
        $form->vinculoLicenca =  $request->vinculoLicenca;
        $form->monitor_primario =  'Primario: ' . $request->monitorPrimario;
        $form->monitor_secundario = 'Secundario: ' . $request->monitorSecundario;
        $form->ramalTelefone =  $request->ramalTelefone;
        $form->tags_hd_primario = 'Primario: ' . $request->tags_hd_primario;
        $form->tags_hd_secundario = 'Secundario: ' . $request->tags_hd_secundario;
        $form->programasInstalados =  $request->tags_programas;
        $form->sistemasQs =  $request->tags_qsistemas;
        $form->user_id = auth()->user()->id;

        $form->save();

        alert()->success('Computador cadastrado com sucesso');
        return back();
    }

    public function update(Request $request)
    {
        $messages = [
            'hostname.required' => 'Erro ao enviar dados verifique o campo hostname',
            'idteamviewer.required' => 'Erro ao enviar dados verifique o campo teamviewer',
            'setorSelect.required' => 'Erro ao enviar dados verifique o campo setor',
            'nomeUsuario.required' => 'Erro ao enviar dados verifique o campo nome usuário',
            'ipv4.required' => 'Erro ao enviar dados verifique o campo endereço IPV4',
            'linkSaida.required' => 'Erro ao enviar dados verifique o campo endereço IPV4(Externo)',
            'qtdMemoria.required' => 'Erro ao enviar dados verifique o campo quantidade de memória',
            'sisOperacional.required' => 'Erro ao enviar dados verifique o campo sistema operacional',
            'vinculoLicenca.required' => 'Erro ao enviar dados verifique o campo vinculo licença',
        ];

        $request->validate([

            'hostname' => 'required',
            'idteamviewer' => 'required',
            'setorSelect' => 'required',
            'nomeUsuario' => 'required',
            'ipv4' => 'required',
            'linkSaida' => 'required',
            'qtdMemoria' => 'required',
            'sisOperacional' => 'required',
            'vinculoLicenca' => 'required',
            'tags_hd_primario' => '',
            'tags_hd_secundario' => '',
            'monitorPrimario' => '',
            'monitorSecundario' => '',
            'ramalTelefone' => '',
            'tags_programas' => '',
            'sistemasQs' => ''

        ], $messages);


        $form = new Computer();
        $form->hostname = $request->hostname;
        $form->idteamviewer = $request->idteamviewer;
        $form->setor =  $request->setorSelect;
        $form->nomeUsuario =  $request->nomeUsuario;
        $form->numeroRemoto = $request->numeroRemoto;
        $form->ipv4 =  $request->ipv4;
        $form->linkSaida =  $request->linkSaida;
        $form->qtdMemoria =  $request->qtdMemoria;
        $form->sisOperacional =  $request->sisOperacional;
        $form->vinculoLicenca =  $request->vinculoLicenca;
        $form->monitor_primario =  $request->monitorPrimario;
        $form->monitor_secundario = $request->monitorSecundario;
        $form->ramalTelefone =  $request->ramalTelefone;
        $form->tags_hd_primario = 'Primario: ' . $request->tags_hd_primario;
        $form->tags_hd_secundario = 'Secundario: ' . $request->tags_hd_secundario;
        $form->programasInstalados =  $request->tags_programas;
        $form->sistemasQs =  $request->tags_qsistemas;
        $form->user_id = auth()->user()->id;

        $form->update();
    }

    public function destroy(Request $request)
    {
        $this->computer->getModel()->where('id', '=', $request->id)->delete();
        alert()->info('Computador removido com sucesso');
        return back();
    }

    public function updateShow($id)
    {
        $computer = $this->computer->getModel()->where('id', '=', $id)->get();
        return view('backend.pages.computer.edit', ['computer' => $computer]);
    }
}
