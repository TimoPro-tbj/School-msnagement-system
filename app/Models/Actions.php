<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $fillable = ['admin_id', 'action'];
    public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}

}


