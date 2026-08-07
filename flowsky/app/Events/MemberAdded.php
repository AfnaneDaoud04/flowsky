<?php

namespace App\Events;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MemberAdded
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Project $project,
        public User $member,
        public string $role,
    ) {
    }
}