<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class NewAnswerSubmitted extends Notification
{
    use Queueable;

    public $question;
    public $answer;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answer, $question, $name)
    {
      $this->question = $question;
      $this->answer = $answer;
      $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new answer was submitted to your question!')
                    ->line("$this->name just suggested: ". $this->answer->content)
                    ->action('View All Answers', route('questions.show', $this->question->id))
                    ->line('Thank you for using LaravelAnswers!');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                ->content("$this->name just submitted an answer to your question! Check it out now at LaravelAnswers.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
