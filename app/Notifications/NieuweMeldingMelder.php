<?php

namespace App\Notifications;

use App\Models\Melding;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NieuweMeldingMelder extends Notification
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
            ->subject('Bedankt voor uw UFO-melding!')
            ->greeting('Beste ' . $notifiable->name . ',')
            ->line('Wij hebben uw melding succesvol ontvangen.')
            ->line('**Datum waarneming:** ' . $this->melding->waarneming_datum->format('d-m-Y H:i'))
            ->line('**Locatie:** ' . $this->melding->locatie)
            ->line('**Categorie:** ' . ($this->melding->categorie_label))
            ->line('Ons team bekijkt uw melding zo snel mogelijk. U kunt de status volgen via uw account.')
            ->action('Mijn meldingen bekijken', url('/mijn-meldingen'))
            ->line('Bedankt voor uw bijdrage aan het UFO Meldpunt!');
    }
}
