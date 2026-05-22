<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Students extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'school_id',
        'image_path',
        'course',
    ];


   public function school():BelongsTo
 {
    return $this->belongsTo(Schools::class, 'school_id');
 }
      public function courses():BelongsTo
 {
    return $this->belongsTo(Courses::class);
 }
       public function teachers():HasMany
 {
    return $this->hasMany(teachers::class);
 }

}
