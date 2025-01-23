<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeOwnerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected Event $event,
        protected string $password
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $eventUrl = config('app.frontend_url')."/event/{$this->event->id}/admin";
        
        return (new MailMessage)
            ->subject('Bem-vindo(a) ao Gerenciador de Eventos!')
            ->greeting("Olá, {$notifiable->name}!")
            ->line("Você foi designado(a) como organizador do evento **{$this->event->name}**.")
            ->line("Aqui estão suas credenciais de acesso ao painel administrativo:")
            ->line("**Usuário:** {$notifiable->email}")
            ->line("**Senha:** {$this->password}")
            ->action('Acessar o Painel Administrativo', $eventUrl)
            ->line('Certifique-se de alterar sua senha assim que acessar o sistema.')
            ->line('Obrigado por usar nosso sistema!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
