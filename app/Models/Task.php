<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{

    use HasFactory;
    protected $table = 'tasks';

    // protected $primaryKey = 'Task _id';

    protected $fillable = [
        'title', 'description', 'name'
    ];

    // public $timestamps = false;

}
