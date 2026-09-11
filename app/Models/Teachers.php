<?php

namespace App\Models;

use App\Models\Schools;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Teachers extends Model
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

 /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'teacher_name',
        'school_id',
        'course',
        'image_path',
        'schoolcode',
        'email',
        'password',
    ];
     public function school():BelongsTo
 {
    return $this->belongsTo(Schools::class);
 }
 public function user()
{
   return $this->hasOne(User::class, 'email', 'email');
   }

      public function courses():HasMany
 {
    return $this->hasMany(Courses::class);
 }
       public function students():HasMany
 {
    return $this->hasMany(Students::class);
 }

}
