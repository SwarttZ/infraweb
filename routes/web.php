<?php

use App\Helpers\PdoBackupHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServidoresController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\SacController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PrintersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackupMysqlController;
use App\Http\Controllers\CarregaErrosBakcups;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\CheckBackupController;
use App\Http\Controllers\ErrosBackupsController;

//Rota login
Route::get('/', [LoginController::class, 'showlogin'])->name('admin.login');

Route::prefix('admin')->group(function () {
    Route::post('/check/login', [LoginController::class, 'postlogin'])->name('admin.check.login');
    Route::get('/show/login', [LoginController::class, 'showlogin'])->name('admin.show.login');
    Route::get('/dashboard', [LoginController::class, 'index'])->name('admin.dashboard')->middleware();
});

//Routes with middleware
Route::group(['middleware' => 'auth'], function () {

    Route::prefix('dashboard')->group(function () {

        //Usuarios
        Route::get('/create/user', [UserController::class, 'index'])->name('admin.create.user');
        Route::post('/store/user', [UserController::class, 'store'])->name('admin.store.user');
        Route::get('/profile/user', [UserController::class, 'profile'])->name('admin.profile.user');
        Route::get('/list/users', [UserController::class, 'show'])->name('admin.list.users');
        Route::post('/search/users', [UserController::class, 'search'])->name('admin.search.users');
        Route::post('/print/users', [UserController::class, 'print'])->name('admin.users.printers');
        Route::post('/download/users', [UserController::class, 'download'])->name('admin.users.download');
        Route::post('/delete/users', [UserController::class, 'destroy'])->name('admin.users.delete');
        Route::post('/crop/photo/user', [UserController::class, 'crop'])->name('admin.users.crop');
        Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('admin.user.update.password');

        //Rotas Backups
        Route::get('/backup', [BackupMysqlController::class, 'index'])->name('admin.backup.show');
        Route::post('/backup/gerar', [BackupMysqlController::class, 'GerarBackup'])->name('admin.backup.generate');

        //Rotas computadores
        Route::get('/create/computer', [ComputerController::class, 'index'])->name('admin.create.computer');
        Route::post('/delete/computer', [ComputerController::class, 'destroy'])->name('admin.delete.computers');
        Route::post('/store/computer', [ComputerController::class, 'store'])->name('admin.store.computer');
        Route::post('/upload/dropzone', [DropzoneController::class, 'upload'])->name('admin.dropzone.upload');



        //Rotas printers
        Route::get('/create/printers', [PrintersController::class, 'index'])->name('admin.create.printers');
        Route::post('/store/printers', [PrintersController::class, 'store'])->name('admin.store.printers');
        Route::get('/list/printers', [PrintersController::class, 'show'])->name('admin.list.printers');
        Route::post('/search/printers', [PrintersController::class, 'search'])->name('admin.search.print');
        Route::post('/print/printers', [PrintersController::class, 'print'])->name('admin.print.printers');
        Route::post('/download/printers', [PrintersController::class, 'download'])->name('admin.printers.download');
        Route::post('/delete/printers', [PrintersController::class, 'destroy'])->name('admin.printers.delete');


        //Rotas monitor
        Route::get('/create/monitor', [MonitorController::class, 'index'])->name('admin.create.monitor');
        Route::post('/store/monitor', [MonitorController::class, 'store'])->name('admin.store.monitor');
        Route::get('/list/monitor', [MonitorController::class, 'show'])->name('admin.list.monitor');
        Route::post('/search/monitor', [MonitorController::class, 'search'])->name('admin.search.monitor');
        Route::post('/print/monitor', [MonitorController::class, 'print'])->name('admin.monitor.print');
        Route::post('/download/monitor', [MonitorController::class, 'download'])->name('admin.monitor.download');
        Route::post('/delete/monitor', [MonitorController::class, 'destroy'])->name('admin.monitor.delete');


        //Rotas Switch
        Route::get('/create/switch', [SwitchController::class, 'index'])->name('admin.create.switch');
        Route::post('/store/switch', [SwitchController::class, 'store'])->name('admin.store.switch');
        Route::get('/list/router', [SwitchController::class, 'show'])->name('admin.list.router');
        Route::post('/search/router', [SwitchController::class, 'search'])->name('admin.search.router');
        Route::post('/print/router', [SwitchController::class, 'print'])->name('admin.router.printers');
        Route::post('/download/router', [SwitchController::class, 'download'])->name('admin.router.download');
        Route::post('/delete/router', [SwitchController::class, 'destroy'])->name('admin.router.delete');


        //Rotas servidores
        Route::get('/create/server', [ServidoresController::class, 'index'])->name('admin.create.server');
        Route::post('/server/store', [ServidoresController::class, 'store'])->name('admin.server.store');
        Route::post('/server/find', [ServidoresController::class, 'ajaxServer'])->name('admin.server.find');
        Route::get('/list/server', [ServidoresController::class, 'show'])->name('admin.list.server');
        Route::post('/search/server', [ServidoresController::class, 'search'])->name('admin.search.server');
        Route::post('/print/server', [ServidoresController::class, 'print'])->name('admin.server.printers');
        Route::post('/download/server', [ServidoresController::class, 'download'])->name('admin.server.download');
        Route::post('/delete/server', [ServidoresController::class, 'destroy'])->name('admin.server.delete');

        //Rota upload ckeditor
        Route::post('/upload/ckeditor', [ServidoresController::class, 'upload'])->name('admin.news.upload');

        //Rota emails
        Route::get('/create/email', [EmailsController::class, 'index'])->name('dashboard.email');
        Route::get('/admin/search/entity/{entity}', [SacController::class, 'search'])->name('dashboard.admin.search.entity');

        //Notifications
        Route::get('/notification/test', [NotificationsController::class, 'index'])->name('admin.notification');

        //Rotas default dashboard
        Route::get('/logout', [LoginController::class, 'logout'])->name('dashboard.logout');

        //Backups clients 
        Route::prefix('error')->group(function () {
            Route::get('/clients/backups', [ClientsController::class, 'index'])->name('dashboard.clients.backup');
            Route::get('/list/backups', [PdoBackupHelper::class, 'retornaQuery'])->name('dashboard.list.backups');
            Route::get('/backups/corrompidos/{data}', [PdoBackupHelper::class, 'corrompidos'])->name('erro.backup.corrompido');
        });
    });

    //ERROS BACKUP
    Route::prefix('error')->group(function () {
        Route::get('/backup/{entity_id}/{entity_name}/{entity_msg}/{data_backup}', [ErrosBackupsController::class, 'index'])->name('erro.backup.show');
        Route::get('/backup/show', [ErrosBackupsController::class, 'index'])->name('erro.show');
        Route::get('/backup/list', [CarregaErrosBakcups::class, 'returnAjax'])->name('error.backup.list');
        Route::get('/backup/delete', [CarregaErrosBakcups::class, 'delete'])->name('error.backup.delete');
        Route::get('/backup/update', [CarregaErrosBakcups::class, 'update'])->name('error.backup.update');
    });

    //Reports
    Route::prefix('reports')->group(function () {
        Route::post('/computer/{id}', [ReportController::class, 'generateReport'])->name('admin.report.computers');
        Route::get('/computer/edit/{id}/', [ComputerController::class, 'updateShow'])->name('admin.update.computers');
        Route::get('/computer/edit/save', [ComputerController::class, 'updateShow'])->name('admin.update.save.computers');
        Route::get('/computer/all', [ReportController::class, 'index'])->name('admin.show.all.computers');
        Route::get('/computer/filter', [ReportController::class, 'advancedFilter'])->name('admin.report.filter.computers');
        Route::get('/create', [ReportController::class, 'createReport'])->name('create.reports');
    });
});
