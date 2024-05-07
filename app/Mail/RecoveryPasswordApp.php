<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryPasswordApp extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Recuperación de contraseña';
    private $token;
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.app.recovery-password', [
            'token' => $this->token,
            'name' => $this->name
        ]);
    }
}
