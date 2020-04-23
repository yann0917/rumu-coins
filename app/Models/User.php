<?php

namespace App\Models;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use HasDateTimeFormatter;

    protected $fillable = [
        'name', 'nickname', 'avatar', 'miniapp_id', 'official_id','unionid', 'sex',
        'country', 'province', 'city', 'email', 'email_verified_at', 'password', 'remember_token',
        'status', 'advance_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'miniapp_id', 'official_id', 'unionid', 'deleted_at', 'email_verified_at',
    ];

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->miniappId;
    }

}
