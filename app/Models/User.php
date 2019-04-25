<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id','username','openid','phone','email','nickname','avatar','country','province','city','language','gender','union_id','password','status','expires','point','test_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 多对多-获取题信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pools()
    {
        return $this->belongsToMany('App\Models\Pool','user_pool')->withPivot('user_id','pool_id','status');
    }

    /**
     * 一对多（反向）获取所属科目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }
}
