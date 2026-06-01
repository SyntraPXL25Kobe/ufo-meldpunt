<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReportUser extends Notification
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
            ->subject('Bedankt voor uw UFO-melding!')
            ->greeting('Beste ' . $notifiable->name . ',')
            ->line('Wij hebben uw melding succesvol ontvangen.')
            ->line('**Datum waarneming:** ' . $this->report->observed_at->format('d-m-Y H:i'))
            ->line('**Locatie:** ' . $this->report->location)
            ->line('**Categorie:** ' . $this->report->category_label)
            ->line('Ons team bekijkt uw melding zo snel mogelijk. U kunt de status volgen via uw account.')
            ->action('Mijn meldingen bekijken', url('/my-reports'))
            ->line('Bedankt voor uw bijdrage aan het UFO Meldpunt!');
    }
}
