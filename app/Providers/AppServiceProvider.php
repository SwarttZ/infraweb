<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\BackupsErros;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Paginator::defaultView('vendor.pagination.bootstrap-4');

        //USERS
        view()->composer('backend.*', function ($view) {
            $user_id = DB::table('table_profile')->get();
            $view->with('user_id', $user_id);
        });

         //USERS
         view()->composer('backend.admin.dashboard', function ($view) {
            $users = DB::table('users')->get();
            $user = $users->count();
            $view->with('user', $user);
        });

        //SERVERS
        view()->composer('backend.admin.dashboard', function ($view) {
            $server = DB::table('servers')->get();
            $servers = $server->count();
            $view->with('servers', $servers);
        });

        //ERRO BACKUPS
        view()->composer('backend.layout.partials.navbar', function ($view) {
            $dt = date('Y-m-d');
            DB::table('erros_backup_mensagem')->truncate();
            $error = DB::connection('backup')->select("SELECT entidade_id, nome_servidor, mensagem_erro, data_backup FROM bkp_erro WHERE data_backup LIKE '%$dt%'");

            foreach ($error as $erro_backup) {

                $backup = new BackupsErros();
                $backup->entidade_id = $erro_backup->entidade_id;
                $backup->nome_servidor = $erro_backup->nome_servidor;
                $backup->mensagem_erro = $erro_backup->mensagem_erro;
                $backup->data_backup = $erro_backup->data_backup;

                $backup->save();
            }
            $erro = DB::table('erros_backup_mensagem')->get();
            $row = count($erro);

            $view->with(
                [
                    'erro' => $erro,
                    'row' => $row
                ]
            );
        });

        //COMPUTER
        view()->composer('backend.pages.computers.*', function ($view) {
            $computer = DB::table('computers')->get();
            $view->with('computer', $computer);
        });

        //MONITORES
        view()->composer('backend.pages.computer.edit', function ($view) {
            $monitor = DB::table('monitores')->get();
            $view->with('monitor', $monitor);
        });
        //PROGRAMAS
        view()->composer('backend.pages.computer.edit', function ($view) {
            $programas = DB::table('programas')->get();
            $programasQuality = DB::table('programasQuality')->get();
            $view->with([
                'programas' => $programas,
                'programasQuality' => $programasQuality
            ]);
        });
        view()->composer('backend.layout.reports.*', function ($view) {
            $computer = DB::table('computers')->get();
            $view->with('computer', $computer);
        });

        //USERS
        view()->composer('backend.pages.users.*', function ($view) {
            $users = DB::table('users')->where('name', '=', auth()->user()->name)->get();
            $status = DB::table('users')->get();
            $view->with([
                'users' => $users,
                'status' => $status
            ]);
        });

        //USERS ASIDE
        view()->composer('backend.layout.partials.*', function ($view) {
            $users = DB::table('users')->where('name', '=', auth()->user()->name)->get();
            $status = DB::table('users')->get();
            $view->with([
                'users' => $users,
                'status' => $status
            ]);
        });

        //SHOW STATUS SERVERS WEB IN HOME PAGE
        view()->composer('backend.layout.partials.content', function ($view) {
            $status_server = DB::table('status_servico')->get();
            $view->with([
                'status_server' => $status_server
            ]);
        });
    }
}
