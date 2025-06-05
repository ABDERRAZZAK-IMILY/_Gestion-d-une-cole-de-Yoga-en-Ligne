<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $fillable = ['name', 'email', 'subscription_expires_at', 'status'];



      public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
