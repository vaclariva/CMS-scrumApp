<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'checklists';

    protected $fillable = [
        'backlog_id',
        'description',
        'status',
    ];

    public function backlog()
    {
        return $this->belongsTo(Backlog::class);
    }

    public function isComplete()
    {
        return $this->status === 'complite';
    }
}
