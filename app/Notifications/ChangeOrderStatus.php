<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeOrderStatus extends Notification
{
    use Queueable;

    private $tracking_no;
    public function __construct($tracking_no)
    {
        $this->tracking_no=$tracking_no;
    }

   
    public function via($notifiable)
    {
        return ['mail'];
    }

    
    public function toMail($notifiable)
    {
        $url='http://127.0.0.1:8000/dashboard/orders'.$this->tracking_no;
        return (new MailMessage)
                 
                    ->subject('تم تخدث حالة الفاتورة')
                    
                    // body message
                    ->greeting('Hello My Customer')
                    ->line('اضافة تحديث حالة طلب جديد')
                    ->line('شكرا لاستخدامك برنامجنا  تحياتي عبدالقوي صلاح');
                    // body message
    }

    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
