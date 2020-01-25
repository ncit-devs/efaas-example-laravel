<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'efaas_id', 'name', 'given_name', 'family_name', 'middle_name', 'gender', 'idnumber', 'email', 'phone_number', 'address', 'fname_dhivehi', 'mname_dhivehi', 'lname_dhivehi', 'user_type', 'verification_level', 'user_state', 'birthdate', 'passport_number', 'is_workpermit_active', 'efaas_updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setEfaasUpdatedAtAttribute($value) {
        return $this->attributes['efaas_updated_at'] = Carbon::parse($value);
    }
}
