<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Quote extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->quote = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->html(
                'Company Name: ' . $this->quote->company . '<br/>' . 
                'Phone Number: ' . "{$this->quote->country_code}-{$this->quote->area_code}-{$this->quote->phone}" . '<br/>' .  
                'Location: ' . "{$this->quote->province}, {$this->quote->city}, {$this->quote->post_code}" . '<br/>' . 
                'Category: ' . $this->quote->category . '<br/>' . 
                'Model Name: ' . $this->quote->model . '<br/>' .
                'Comments:' . nl2br(htmlspecialchars($this->quote->comments))
            )->subject('Request to Quote')
            ->from($this->quote->mail, 
                "{$this->quote->salutation} {$this->quote->first_name} {$this->quote->mid_name} {$this->quote->last_name}");
    }
}
