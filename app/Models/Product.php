<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
      'icon',
      'name',
      'label',
      'start_date',
      'end_date',
      'user_id',
    ];

    protected $casts = [
       'start_date' =>  'datetime',  
       'end_date' =>  'datetime'   
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vision_board()
    {
        return $this->hasMany(VisionBoard::class);
    }
}
