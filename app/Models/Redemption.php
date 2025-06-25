<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $fillable = ['user_id','benefit_type','points_spent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
