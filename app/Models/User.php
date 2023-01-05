<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'gender',
    ];
    const COL_ORDERS = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAdminFilter($q,$type){

        $q->whereNotIn('role',[Enum::CUSTOMER]);

        if(@request('search')['value']){
            $value = request('search')['value'];
            return $q->whereRaw("concat(name, ' ',email) like '%" . $value . "%' ");
        }
        return $q;
    }
    public function scopeCustomerFilter($q,$type){

        $q->whereIn('role',[Enum::CUSTOMER]);

        if(@request('search')['value']){
            $value = request('search')['value'];
            return $q->whereRaw("concat(name, ' ',email) like '%" . $value . "%' ");

        }
        return $q;
    }
}
