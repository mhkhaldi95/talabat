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
    ];

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

    public function scopeFilter($q,$type){

        if(auth()->user()->role == Enum::SUPER_ADMIN){
            $q->whereNotIn('role',[Enum::CUSTOMER]);
        }elseif(auth()->user()->role == Enum::ADMIN){
            $q->where('role',Enum::ADMIN);
        }elseif(auth()->user()->role == Enum::CUSTOMER){
            return ;
        }


        if(@request('search')['value']){
            $q->where('name','like','%'.request('search')['value'].'%')->orWhere('email','like','%'.request('search')['value'].'%');
        }
        return $q;
    }
}
