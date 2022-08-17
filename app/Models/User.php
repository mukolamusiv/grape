<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Attachment\Attachable;
use Orchid\Metrics\Chartable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable,Chartable,\Laravel\Sanctum\HasApiTokens, HasApiTokens, CanResetPassword, Attachable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'surname',
        'birthday',
        'photo'
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
        'surname',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'surname',
        'updated_at',
        'created_at',
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function waters(){
        return $this->hasMany(Water::class,'user_id','id');
    }

    public function topic(){
        return $this->hasMany(UserTopic::class,'user_id','id')->with('topic');
    }

    public function topic_active(){
        return $this->hasMany(UserTopic::class,'user_id','id')->with('topic')->where('complete','=',false);
    }

    public function topic_done(){
        return $this->hasMany(UserTopic::class,'user_id','id')->with('topic')->where('complete','=',true);
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn($value)=> $value,
                set: fn($value)=> '/storage/'.$value
        );
    }
}
