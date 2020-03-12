<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Rest;

class ListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $request; 
   
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // $this->request = $request;  
           
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {   
        $this->request = $request; 
        $rest= new Rest;         
        $rest->first_name = $this->request->input('first_name');
        $rest->last_name = $this->request->input('last_name');
        $rest->fullname = $this->request->input('fullname');
        $rest->save();
    }
}
