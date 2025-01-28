<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CheckAuthRole;
use App\Http\Controllers\Owner;
use App\Http\Controllers\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::loginUsingId(2);
Route::get('/events', [Site\EventController::class, 'index']);
Route::get('/events/{event}', [Site\EventController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/check-role/{role}', CheckAuthRole::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Super Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        // Route::get('/', [AdminController::class, 'dashboard']); // Dashboard do Super Admin
        Route::apiResource('events', Admin\EventController::class);
        Route::post('/events/{uuid}/send-link', [Admin\EventController::class, 'sendLink']); // Enviar link para responsável
    });

    // Event Admin Routes
    Route::post('/event/login', Owner\AuthController::class); // Registrar check-in por QR code
    Route::middleware(['role:event_owner'])->prefix('dashboard')->group(function () {
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
    });


    // Staff Routes
    Route::middleware(['role:staff'])->group(function () {
        // Route::get('/events/{uuid}/staff/check-in', [CheckInController::class, 'index']); // Painel de check-in
        // Route::post('/events/{uuid}/staff/check-in', [CheckInController::class, 'store']); // Registrar check-in por QR code
        // Route::post('/events/{uuid}/staff/check-in/manual', [CheckInController::class, 'manual']); // Cadastro manual de visitante
    });

    Route::middleware(['auth:sanctum', 'role:visitor'])->group(function () {
        // Route::post('/events/{uuid}/register', [EventVisitorController::class, 'register']);
        // Route::get('/events/my-events', [EventVisitorController::class, 'myEvents']);
    });
});
