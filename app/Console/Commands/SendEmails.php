<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Mail\SendEmail;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly email to all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $weekAgo = Carbon::now()->subDays(7); // 7 days ago
        $users = User::all();
        foreach($users as $user)
        {
            $posts_number = Post::where('created_at', '>=', $weekAgo)
                            ->where('user_id', $user->id)
                            ->count();
            //send mail to all users
            Mail::to($user->email)->send(new SendEmail($posts_number));
        }
    }
}
