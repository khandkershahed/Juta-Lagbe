<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $setting;
    /**
     * Create a new notification instance.
     */
    public function __construct($data, $setting)
    {
        $this->data = $data;
        $this->setting = $setting;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    public function build()
    {
        return $this->from('support@neezpackages.com', $this->setting->website_name)
            ->subject('Welcome to'.$this->setting->website_name)
            ->view('mail.user_registration', [
                'data' => $this->data,
                'setting'=> $this->setting,
            ]);
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Welcome to'.$this->setting->website_name,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            // view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
