<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    public $contact;

    /**
     * Create a new notification instance.
     *
     * @param  array  $contact
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Contact Form Submission')
            ->greeting('Hello Admin,')
            ->line('You have received a new contact form submission:')
            ->line('**Name:** ' . $this->contact['name'])
            ->line('**Email:** ' . $this->contact['email'])
            ->line('**Phone:** ' . $this->contact['phone'])
            ->line('**Message:** ' . $this->contact['message'])
            ->line('**Property Owner:** ' . $this->contact['vendor'])
            ->line('**Property Name:** ' . $this->contact['property'])
            ->line('Thank you!')
            ->salutation('Best regards,');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'contact' => $this->contact,
        ];
    }
}
