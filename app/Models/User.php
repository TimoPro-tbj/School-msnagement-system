<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Schools;
use App\Models\Teachers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable // implements MustVerifyEmail
{
    protected $fillable = ['school_id','name','email','password','role'];

    public function school() {
        return $this->belongsTo(Schools::class);
    }
    // In Teacher.php

// In User.php
public function teacher()
{

    return $this->belongsTo(Teachers::class, 'email', 'email');}

}
