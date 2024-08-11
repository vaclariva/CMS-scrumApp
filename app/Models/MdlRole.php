<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MdlRole extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'tbl_role';

    protected $fillable = [
        'role_name',
    ];

    protected $primaryKey = 'role_id';
    public $incrementing = true;

    public $timestamps = true;
}

