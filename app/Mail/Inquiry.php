<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->inquiry = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->html(
            'Company Name: ' . $this->inquiry->company . '<br/>' . 
            'Phone Number: ' . $this->inquiry->phone . '<br/>' .
            'Comments:' . nl2br(htmlspecialchars($this->inquiry->comments))
        )->subject($this->inquiry->subject)
        ->from($this->inquiry->email, $this->inquiry->name);
    }
}
