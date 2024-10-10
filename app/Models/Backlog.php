<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $table = 'backlogs';

    protected $fillable = [
        'name',
        'description',
        'priority',
        'hours',
        'status',
        'sprint_id',
        'product_id',
    ];

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function incompleteChecklists()
    {
        return $this->checklists()->where('status', 'belum');
    }
}
