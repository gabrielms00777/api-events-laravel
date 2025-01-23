<?php

use App\Http\Controllers\Admin\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Super Admin Routes
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('events', EventController::class);
    // Route::get('/admin', [AdminController::class, 'dashboard']); // Dashboard do Super Admin
    // Route::get('/admin/events', [EventController::class, 'index']); // Listar todos os eventos
    // Route::post('/admin/events', [EventController::class, 'store']); // Criar um novo evento
    // Route::get('/admin/events/{uuid}', [EventController::class, 'show']); // Detalhes de um evento
    // Route::put('/admin/events/{uuid}', [EventController::class, 'update']); // Atualizar evento
    // Route::delete('/admin/events/{uuid}', [EventController::class, 'destroy']); // Excluir evento
    // Route::post('/admin/events/{uuid}/send-link', [EventController::class, 'sendLink']); // Enviar link para responsável
});

// Event Admin Routes
Route::middleware(['auth:sanctum', 'role:event_owner'])->group(function () {
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
