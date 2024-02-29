<?php

namespace App\Mail;

use App\Models\Newsletter;
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

    public function __construct($subject, $content, $newsletter)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->newsletter = $newsletter;
    }

    public function build()
    {
        $newsletters = Newsletter::all();
        return $this->view('newsletter.index',compact('newsletters'))->with(['content' => $this->content,])->subject($this->subject);
    }
}
