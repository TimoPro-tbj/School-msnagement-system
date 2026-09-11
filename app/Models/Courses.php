<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courses extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'course_name',
        'school_id',
    ];

       public function school():BelongsTo
 {
    return $this->belongsTo(Schools::class);
 }
      public function students():HasMany
 {
    return $this->hasMany(Students::class, 'course_id');
 }
       public function teachers():HasMany
 {
    return $this->hasMany(teachers::class);
 }

}
