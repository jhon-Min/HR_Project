<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
