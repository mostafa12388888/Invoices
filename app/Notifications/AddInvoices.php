<?php

namespace App\Notifications;

use App\Models\invoices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoices extends Notification
{
    use Queueable;
    private $invoices_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    
    public function __construct($invoices_id)
    {
        $this->invoices_id=$invoices_id;
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
        $linke='http://127.0.0.1:8000/details-Invoices/'.$this->invoices_id;
        return (new MailMessage)
                    ->subject('تم اضافه فاتوره جديده')
                    ->line('اهلا بكم في شركه المصطفي للقروض ')
                    ->action('تفاصيل الفاتوره', $linke)
                    ->line('لقد تم اضافه الفاتوره بنجاح ');
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
            //
        ];
    }
}
