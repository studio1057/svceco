<?php

namespace App\Jobs;

use App\User;
use App\Notification;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class CreateNotification extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $userId;
    protected $body;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $body)
    {
        $this->userId = $userId;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::Where('id', '=', $this->userId)->get();

        if(!$user->IsEmpty() ) {
            $user = $user[0];
            $Notify = new Notification([
                "user_id" => $this->userId,
                "message" => $this->body
            ]);
            $Notify->save();


            Mail::queue('emails.notification', ['name' => $user->first_name, 'body' => $this->body] , function ($message) use ($user) {
                $message->from("noreply@svceco.com","svceco.com");
                $message->to($user->email, $user->first_name)->subject('Notification from svceco.com!');
            });
        }


    }
}
