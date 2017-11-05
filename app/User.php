<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function routeNotificationForNexmo()
    {
      return $this->phone;
    }

    public function routeNotificationForSlack()
    {
      return env('SLACK_WEBHOOK');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = array('thumbnail');

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
      return $this->hasMany('App\Question');
    }

    public function answers()
    {
      return $this->hasMany('App\Answer');
    }

    public function getThumbnailAttribute()
    {
      $path = pathinfo($this->profile_pic);
      return $path['dirname'].'/'.$path['filename']."-thumb.jpg";
    }

}
