<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    Use Sluggable;
    Use SluggableScopeHelpers;
    protected $fillable=['title','body','food','sightseeing','city_id','user_id','is_active','slug'];

    public function sluggable():array
    {
        return[
            'slug'=>[
                'source'=>'title',
                'onUpdate' => true,
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function photos(){

        return $this->hasMany(Photo::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }
}
