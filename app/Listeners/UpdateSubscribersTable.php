<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateSubscribersTable
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSubscribed $event): void
    {
        try {
            DB::insert('insert into subscribers (email) values (?)', [$event->user->email]);
        } catch (\Exception $e) {
            \Log::error('Failed to insert subscriber: ' . $e->getMessage());
        }    }
}
