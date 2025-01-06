<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $data;
    public $setting;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param array $data
     * @param object $setting
     */
    public function __construct($name, $data, $setting)
    {
        $this->name = $name;
        $this->data = $data;
        $this->setting = $setting;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('support@neezpackages.com', $this->setting->website_name)
            ->subject($this->setting->website_name . ' Order Placed. (Order #' . $this->data['order']->order_number . ')')
            ->view('mail.user_order')
            ->with([
                'setting'       => $this->setting,
                'order'         => $this->data['order'],
                'order_items'   => $this->data['order_items'],
                'user'          => $this->data['user'],  // Add user data if needed
            ]);
            // ->view('mail.user_order')
            // ->with([
            //     'data' => $this->data,
            // ]);
    }
}
