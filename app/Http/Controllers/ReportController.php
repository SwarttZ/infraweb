<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Models\Computer;

require __DIR__ . '/../../../vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ReportController extends Controller
{

    protected $model;

    public function __construct(Computer $computer)
    {
        $this->model = new Repository($computer);
        $this->computer = $computer;
    }

    public function index()
    {
        $computer = DB::table('computers')
            ->paginate(6);

        return view('backend.pages.computer.index', [
            'computer' => $computer,
        ]);
    }
    public function generateReport(Request $request)
    {
        if ($request->id != 0) {
            require_once(public_path() . '/tcpdf/mypdf.php');

            $pdf = new \MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Quality Sistemas');
            $pdf->SetTitle('Relatório computadores');

            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }


            $pdf->setFontSubsetting(true);
            $pdf->SetFont('arial', '', 10, '', true);
            $pdf->AddPage('P', 'A4');



            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            $computer = DB::table('computers')
                ->where('id', '=', $request->id)
                ->get();


            foreach ($computer as $computers) {
                $content = '
            <br /><br /><br /><br /><h3>Nome do usuário: ' . $computers->nomeUsuario . '</h3>
            <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;">
                <tr style="color:white;background-color:black;">            
                        <th>Hostname</th>
                        <th>Id/Teamviewer</th>
                        <th>Setor</th>
                        <th>Usuário/Ad</th>
            </tr>';

                $content .=  '<tr>';
                $content .=  '<td>' . $computers->hostname . '</td>';
                $content .=  '<td>' . $computers->idteamviewer . '</td>';
                $content .=  '<td>' . $computers->setor . '</td>';
                $content .=  '<td>' . $computers->nomeUsuario . '</td>';
                $content .=  '</tr>';

                $content .= '
                <tr style="color:white;background-color:black;">   
                        <th>Qtd/Memoria</th>
                        <th>HDs</th>
                        <th>Monitores</th>
                        <th>Sistema/Os</th>
                </tr>';

                $content .=  '<tr>';
                $content .=  '<td>' . $computers->qtdMemoria . '</td>';
                $content .=  '<td>' . $computers->tags_hd_primario . ' ' . $computers->tags_hd_secundario . '</td>';
                $content .=  '<td>' . $computers->monitor_primario . ' ';
                $content .=  $computers->monitor_secundario . '</td>';
                $content .=  '<td>' . $computers->sisOperacional . '</td>
                </tr>';

                $content .= '
                <tr style="color:white;background-color:black;">   
                        <th>Vinculo/Licença</th>
                        <th>Ramal/Telefone</th>
                        <th>Programas/Quality</th>
                        <th>IPV4</th>
                </tr>';

                $content .=   '<tr>';
                $content .=  '<td>' . $computers->vinculoLicenca . '</td>';
                $content .=  '<td>' . $computers->ramalTelefone . '</td>';
                $content .=  '<td>' . $computers->sistemasQs . '</td>';
                $content .=  '<td>' . $computers->ipv4 . '</td>';
                $content .=  '</tr>';
                $content .= '
                <tr style="color:white;background-color:black;">   
                      <th colspan="4">Programas/Terceiros</th>
                </tr>';

                $content .=   '<tr>';
                $content .=  '<td colspan="4">' . $computers->programasInstalados . '</td>
                </tr>';
            }

            $content .= '</table>';
            $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);
            $pdf->Output('computer' . rand(0, 10000) . date('YHd') . '.pdf', 'I');
        } else {
            alert()->warning('Algo deu errado');
            return back();
        }
    }

    /**
     * @param ComputerCreatedRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function advancedFilter(Request $request)
    {
        if ($request->name == null) {
            alert()->warning('É necessario selecionar um filtro');
            return back();
        }

        require_once(public_path() . '/tcpdf/mypdf.php');

        $pdf = new \MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Quality Sistemas');
        $pdf->SetTitle('Relatório computadores');

        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }


        $pdf->setFontSubsetting(true);
        $pdf->SetFont('arial', '', 10, '', true);
        $pdf->AddPage('P', 'A4');



        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $computer = $this->computer->getModel()->where('nomeUsuario', '=', $request->name)->get();

        if ($computer->isNotEmpty()) {


            foreach ($computer as $computers) {
                $content = '
            <br /><br /><br /><br /><h3>Nome do usuário: ' . $computers->nomeUsuario . '</h3>
            <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;">
                <tr style="color:white;background-color:black;">            
                        <th>Hostname</th>
                        <th>Id/Teamviewer</th>
                        <th>Setor</th>
                        <th>Usuário/Ad</th>
            </tr>';

                $content .=  '<tr>';
                $content .=  '<td>' . $computers->hostname . '</td>';
                $content .=  '<td>' . $computers->idteamviewer . '</td>';
                $content .=  '<td>' . $computers->setor . '</td>';
                $content .=  '<td>' . $computers->nomeUsuario . '</td>';
                $content .=  '</tr>';

                $content .= '
                <tr style="color:white;background-color:black;">   
                        <th>Qtd/Memoria</th>
                        <th>HDs</th>
                        <th>Monitores</th>
                        <th>Sistema/Os</th>
                </tr>';

                $content .=  '<tr>';
                $content .=  '<td>' . $computers->qtdMemoria . '</td>';
                $content .=  '<td>' . $computers->tags_hd_primario . ' ' . $computers->tags_hd_secundario . '</td>';
                $content .=  '<td>' . $computers->monitor_primario . ' ';
                $content .=  $computers->monitor_secundario . '</td>';
                $content .=  '<td>' . $computers->sisOperacional . '</td>
                </tr>';

                $content .= '
                <tr style="color:white;background-color:black;">   
                        <th>Vinculo/Licença</th>
                        <th>Ramal/Telefone</th>
                        <th>Programas/Quality</th>
                        <th>IPV4</th>
                </tr>';

                $content .=   '<tr>';
                $content .=  '<td>' . $computers->vinculoLicenca . '</td>';
                $content .=  '<td>' . $computers->ramalTelefone . '</td>';
                $content .=  '<td>' . $computers->sistemasQs . '</td>';
                $content .=  '<td>' . $computers->ipv4 . '</td>';
                $content .=  '</tr>';
                $content .= '
                <tr style="color:white;background-color:black;">   
                      <th colspan="4">Programas/Terceiros</th>
                </tr>';

                $content .=   '<tr>';
                $content .=  '<td colspan="4">' . $computers->programasInstalados . '</td>
                </tr>';
            }

            $content .= '</table>';
            $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);
            $pdf->Output('computer' . rand(0, 10000) . date('YHd') . '.pdf', 'I');
        }
        alert()->warning('Computador não encontrado');
        return back();
    }

    public function createReport(Request $request)
    {
        return true;
    }
}
