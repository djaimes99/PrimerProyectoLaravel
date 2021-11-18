<?php
use App\Http\Livewire\ShowGerencias;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GerenciaController;
use App\Http\Controllers\Admin\CoordinacioneController;
use App\Http\Controllers\Admin\ObjetivoController;
use App\Http\Controllers\Admin\MetaController;
use App\Http\Controllers\Admin\ActividadeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PlanificacioneController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\DesgloseController;

Route::get('', [HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('users', UserController::class)->names('admin.users');

Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('gerencias', GerenciaController::class)->names('admin.gerencias');

Route::resource('coordinaciones', CoordinacioneController::class)->names('admin.coordinaciones');

Route::resource('objetivos', ObjetivoController::class)->names('admin.objetivos');

Route::resource('metas', MetaController::class)->names('admin.metas');

Route::resource('actividades', ActividadeController::class)->names('admin.actividades');

Route::resource('planificaciones', PlanificacioneController::class)->names('admin.planificaciones');

Route::get('charts', [ChartController::class, 'index'])->name('admin.charts.index');

Route::get('charts/barchart', [ChartController::class, 'barchart'])->name('admin.charts.barchart');

Route::resource('desgloses', DesgloseController::class)->names('admin.desgloses');

//Route::get('metas', [MetaController::class, 'index'])->name('admin.metas.index');

//Route::get('metas/create', [MetaController::class, 'create'])->name('admin.metas.create');

////Route::get('metas', [MetaController::class, 'store'])->name('admin.metas.store');


//Route::resource('actividades', ActividadeController::class)->names('admin.actividades');

//Route::get('metas', [ChartController::class,'barChart'])->name('admin.metas.barchart');




