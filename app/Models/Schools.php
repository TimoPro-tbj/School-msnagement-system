<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Schools extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'schoolname',
        'schoolcode',
        'badge_path',
    ];
     public function user():HasOne
 {
       return $this->hasOne(User::class, 'school_id');
 }
      public function courses():HasMany
 {
    return $this->hasMany(Courses::class);
 }
       public function teachers():HasMany
 {
    return $this->hasMany(teachers::class);
 }

}
