<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'created_by', 'title', 'description', 'priority', 'status', 'due_date'];
    protected $casts = ['due_date' => 'date'];

    public function project() { return $this->belongsTo(Project::class); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function assignees() { return $this->belongsToMany(User::class, 'task_user'); }

    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== 'done';
    }
    public function notes(): HasMany
{
    return $this->hasMany(Note::class)->latest();
}
}
