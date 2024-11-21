<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CustomPasswordReset extends Mailable
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        // Gera o link de redefinição de senha
        $resetLink = url('reset-password/'.$this->token.'?email='.$this->email);

        return $this->subject('Redefinir Senha')
                    ->view('emails.password_reset')  // Define a view do e-mail
                    ->with([
                        'resetLink' => $resetLink,  // Passa o link para a view
                    ]);
    }
}

