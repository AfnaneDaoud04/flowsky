<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\TaskCreated;
use App\Events\TaskStatusChanged;
use App\Events\MemberAdded;
use App\Events\NoteAdded;
use App\Listeners\LogTaskCreated;
use App\Listeners\LogTaskStatusChanged;
use App\Listeners\LogMemberAdded;
use App\Listeners\LogNoteAdded;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(TaskCreated::class, LogTaskCreated::class);
        Event::listen(TaskStatusChanged::class, LogTaskStatusChanged::class);
        Event::listen(MemberAdded::class, LogMemberAdded::class);
        Event::listen(NoteAdded::class, LogNoteAdded::class);
    }
}