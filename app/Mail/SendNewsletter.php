<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $newsletter;
    public $imagePath;

    public function __construct($subject, $content, $newsletter, $imagePath)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->newsletter = $newsletter;
        $this->imagePath = $imagePath;
    }

    public function build()
    {
        return $this->view('emails.newsletter')
                    ->subject($this->subject)
                    ->with([
                        'content' => $this->content,
                        'newsletter' => $this->newsletter,
                        'imagePath' => $this->imagePath,
                    ]);
    }
}
