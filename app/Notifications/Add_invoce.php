<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;

class Add_invoce extends Notification
{
    use Queueable;
private $invoices;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoices)
    {
$this->invoices=$invoices;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
   
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title'=>'تم اضافه الفاتوره بواسطه : ',
           'id'=>$this->invoices,
            'user'=>Auth::user()->name,
        ];
    }
}
