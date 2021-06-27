<?php

namespace App\Jobs;

use App\Models\DailyLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SaveRandomQuote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = Http::get('https://api.quotable.io/random');
        DailyLog::create([
            'log' => $content['content'],
            'day' => $this->date,
            'user_id' => $this->user->id
        ]);
    }
}
