<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'created_by'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function roleFor(User $user): ?string
 {
    $member = $this->users->firstWhere('id', $user->id);
    return $member?->pivot->role;
 }

 public function tasks() { return $this->hasMany(Task::class); }
 public function activities(): \Illuminate\Database\Eloquent\Relations\HasMany
{
    return $this->hasMany(Activity::class)->latest();
}
}
