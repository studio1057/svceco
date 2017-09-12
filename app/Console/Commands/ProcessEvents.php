<?php namespace App\Console\Commands;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Event;
use App\Attendance;
use App\Jobs\CreateNotification;
use Carbon\Carbon;

class ProcessEvents extends Command
{
    use DispatchesCommands;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'process-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Events.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        $Events = Event::Where('start_time', '<', Carbon::now())->where('status', '=', 'pending')->get();

        if(!$Events->isEmpty() ) {

            foreach($Events as $Event)
            {
                $Event->status = "started";
                $Event->save();

                $Users = Attendance::where('event_id', '=', $Event->id)->get();

                foreach($Users as $User) {


                    $this->dispatch(new CreateNotification($User->user_id,"Event " . $Event->name . " has started."));
                }
            }
        }

        $Events = Event::Where('end_time', '<', Carbon::now())->where('status', '=', 'started')->get();

        if(!$Events->isEmpty() ) {

            foreach($Events as $Event)
            {
                $Event->status = "ended";
                $Event->save();
            }
        }


        // Process the event.
        $Events = Event::Where('status', '=', 'processing')->get();

        if(!$Events->isEmpty() ) {

            foreach($Events as $Event)
            {
                $Event->status = "completed";
                $Event->save();

                $Users = Attendance::where('event_id', '=', $Event->id)->where('checked_in', '=', true)->get();

                foreach ($Users as $User) {

                    $User->user->volunteer->current_credits = $User->user->volunteer->current_credits + $Event->credits;

                    $User->user->volunteer->save();
                    $User->user->save();


                    $this->dispatch(new CreateNotification($User->user_id,"Event " . $Event->name . " has ended."));
                }
            }
        }
    }


}
