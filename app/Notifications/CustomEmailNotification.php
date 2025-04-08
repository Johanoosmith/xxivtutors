<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notification;
use App\Models\NotificationTemplate;
use App\Mail\Email;


class CustomEmailNotification extends Notification
{
    use Queueable;

    protected $email;
    protected $data;
    protected $event;

    public function __construct($email, $data, $event)
    {
        $this->email = $email;  // Dynamic recipient
        $this->data = $data;    // Dynamic data to replace placeholders
        $this->event = $event;  // Event to fetch email template
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Fetch email template from DB
        $template = NotificationTemplate::where('slug', $this->event)->first();

        if (!$template) {
            return (new MailMessage)
                ->subject('Default Subject')
                ->line('No email template found for this event.');
        }

        // Replace placeholders in email body
        $email_body		= $this->replacePlaceholders($template->email_body, $this->data);
		$email_subject	= $this->replacePlaceholders($template->subject, $this->data);
		
		//dd('Testing-toMail', $email_body, $this->data);
		
		return (new Email($this->email, $email_subject, $email_body));
		
		/*
        return (new MailMessage)
            ->subject($email_subject)
            ->greeting('Hello!')
            ->line($email_body);
			
		*/
    }

    private function replacePlaceholders($body, $data)
    {
        foreach ($data as $key => $value) {
            $body = str_replace("{{$key}}", $value, $body);
        }
        return $body;
    }

    public function routeNotificationForMail($notifiable)
    {
        return $this->email; // Send to the dynamic email
    }
}
