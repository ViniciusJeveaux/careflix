<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    public function show() {
        return $this->belongsTo(Show::class);
    }

    public function videos() {
        return $this->hasMany(ShowVideo::class);
    }
}
