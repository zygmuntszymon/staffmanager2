<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password','role','points'];
    protected $hidden   = ['password','remember_token'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }
}
