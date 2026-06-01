<?php

namespace App\Notifications;

use App\Models\Melding;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NieuweMeldingAdmin extends Notification
{
    use Queueable;

    public function __construct(public readonly Melding $melding) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nieuwe UFO-melding ontvangen #' . $this->melding->id)
            ->greeting('Hallo,')
            ->line('Er is een nieuwe melding ingediend op het UFO Meldpunt.')
            ->line('**Melding #:** ' . $this->melding->id)
            ->line('**Datum waarneming:** ' . $this->melding->waarneming_datum->format('d-m-Y H:i'))
            ->line('**Locatie:** ' . $this->melding->locatie)
            ->line('**Categorie:** ' . ($this->melding->categorie_label))
            ->line('**Melder:** ' . ($this->melding->user?->name ?? 'Gast'))
            ->action('Melding bekijken in admin', url('/admin/meldingen/' . $this->melding->id . '/edit'))
            ->line('Log in op het admin dashboard om de melding te behandelen.');
    }
}
