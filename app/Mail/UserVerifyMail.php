<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserVerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $setting;

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
     */
    public function build()
    {
        return $this->from('support@neezpackages.com', $this->setting->website_name)
            ->subject($this->setting->website_name . 'Acccount Verified!')
            ->view('mail.user_verify', [
                'data' => $this->data,
            ]);
    }

    public function envelope()
    {
        return new Envelope(
            subject: $this->setting->website_name . 'Acccount Verified!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
