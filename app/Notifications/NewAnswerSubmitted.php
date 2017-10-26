<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;

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
        return ['mail', 'nexmo', 'slack'];
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

    public function toSlack($notifiable)
    {
      $url = route('questions.show', $this->question->id);
      return (new SlackMessage)
                  ->from('Laravel Answers Bot', ':robot_face:')
                  ->to('#random')
                  ->content("$this->name just submitted an answer to your question! Check it out now at LaravelAnswers.")
                  ->attachment(function ($attachment) use ($url) {
                      $attachment->title($this->question->title, $url)
                                 ->fields([
                                  'Question Title' => $this->question->title,
                                  'Submitter\'s Name' => $this->name,
                                  'Answer' => $this->answer->content,
                                  'Validated User' => ':+1:'
                                 ]);
                  });
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
