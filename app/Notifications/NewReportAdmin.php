<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReportAdmin extends Notification
{
    use Queueable;

    public function __construct(public readonly Report $report) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nieuwe UFO-melding ontvangen #' . $this->report->id)
            ->greeting('Hallo,')
            ->line('Er is een nieuwe melding ingediend op het UFO Meldpunt.')
            ->line('**Melding #:** ' . $this->report->id)
            ->line('**Datum waarneming:** ' . $this->report->observed_at->format('d-m-Y H:i'))
            ->line('**Locatie:** ' . $this->report->location)
            ->line('**Categorie:** ' . $this->report->category_label)
            ->line('**Melder:** ' . ($this->report->user?->name ?? 'Gast'))
            ->action('Melding bekijken in admin', url('/admin/reports/' . $this->report->id . '/edit'))
            ->line('Log in op het admin dashboard om de melding te behandelen.');
    }
}
