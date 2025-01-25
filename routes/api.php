<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::loginUsingId(2);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Super Admin Routes
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('events', Admin\EventController::class);
    // Route::get('/', [AdminController::class, 'dashboard']); // Dashboard do Super Admin
    Route::post('/events/{uuid}/send-link', [Admin\EventController::class, 'sendLink']); // Enviar link para responsável
});

// Event Admin Routes
Route::post('/event/login', Owner\AuthController::class); // Registrar check-in por QR code
Route::middleware(['auth:sanctum', 'role:event_owner'])->prefix('dashboard')->group(function () {
    Route::get('/', [Owner\EventController::class, 'show']); // Painel principal do evento atual
    Route::get('/events', [Owner\EventController::class, 'index']); // Listar eventos
    Route::post('/select-event', [Owner\EventController::class, 'selectEvent']); // Listar eventos
    Route::get('/staff', [Owner\StaffController::class, 'index']); // Listar funcionários
    Route::post('/staff', [Owner\StaffController::class, 'store']); // Adicionar funcionário
    Route::delete('/staff/{staffId}', [Owner\StaffController::class, 'destroy']); // Remover funcionário
    Route::get('/visitors', [Owner\VisitorController::class, 'index']); // Listar visitantes
    Route::post('/visitors', [Owner\VisitorController::class, 'store']); // Cadastrar visitante
    Route::get('/visitors/{visitorId}', [Owner\VisitorController::class, 'show']); // Detalhes de visitante
    Route::post('/visitors/{visitorId}/resend', [Owner\VisitorController::class, 'resendQrCode']); // Reenviar QR code
    
    // // Rota para alternar eventos
    // Route::post('/select-event', [EventAdminController::class, 'selectEvent']); // Selecionar evento para gerenciar

    // Route::get('/events/{uuid}/admin', [EventAdminController::class, 'dashboard']); // Painel principal do evento
    // Route::get('/events/{uuid}/admin/staff', [StaffController::class, 'index']); // Listar funcionários
    // Route::post('/events/{uuid}/admin/staff', [StaffController::class, 'store']); // Adicionar funcionário
    // Route::delete('/events/{uuid}/admin/staff/{staffId}', [StaffController::class, 'destroy']); // Remover funcionário
    // Route::get('/events/{uuid}/admin/visitors', [VisitorController::class, 'index']); // Listar visitantes
    // Route::post('/events/{uuid}/admin/visitors', [VisitorController::class, 'store']); // Cadastrar visitante
    // Route::get('/events/{uuid}/admin/visitors/{visitorId}', [VisitorController::class, 'show']); // Detalhes de visitante
    // Route::post('/events/{uuid}/admin/visitors/{visitorId}/resend', [VisitorController::class, 'resendQrCode']); // Reenviar QR code
    // Route::get('/events/{uuid}/admin/reports', [ReportController::class, 'index']); // Relatórios do evento

});


// Staff Routes
Route::middleware(['auth:sanctum', 'role:staff'])->group(function () {
    // Route::get('/events/{uuid}/staff/check-in', [CheckInController::class, 'index']); // Painel de check-in
    // Route::post('/events/{uuid}/staff/check-in', [CheckInController::class, 'store']); // Registrar check-in por QR code
    // Route::post('/events/{uuid}/staff/check-in/manual', [CheckInController::class, 'manual']); // Cadastro manual de visitante
});

// Route::middleware(['auth:sanctum', 'role:staff'])->group(function () {
//     Route::get('/events/{uuid}/staff/check-in', [CheckInController::class, 'index']); // Painel de check-in
//     Route::post('/events/{uuid}/staff/check-in', [CheckInController::class, 'store']); // Registrar check-in por QR code
//     Route::post('/events/{uuid}/staff/check-in/manual', [CheckInController::class, 'manual']); // Cadastro manual de visitante
// });
