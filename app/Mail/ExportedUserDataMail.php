<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExportedUserDataMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $path;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $path
     */
    public function __construct($email, $path)
    {
        $this->email = $email;
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = settingsRepository()->getCompanyName();

        return $this->markdown('mail.export_data')
            ->subject(trans('mail.export_data_subject', ['company' => $company]))
            ->to($this->email);
    }
}
