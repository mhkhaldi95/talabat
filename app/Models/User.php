<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\Enum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
class User extends Authenticatable implements Wallet
{
    use HasApiTokens, HasFactory, Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;
    use HasWallet;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const FILLABLE = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'gender',
        'fcm_token',
        'photo',
    ];
    protected $fillable = self::FILLABLE;
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
    protected $appends = ['photo_path'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAdminFilter($q,$type){

        $q->where('id','!=',Auth::id())->whereIn('role',[Enum::ADMIN,Enum::SUPER_ADMIN]);

        if(@request('search')['value']){
            $value = request('search')['value'];
            return $q->whereRaw("concat(name, ' ',email) like '%" . $value . "%' ");
        }
        return $q;
    }
    public function scopeCustomerFilter($q){

        $q->whereIn('role',[Enum::CUSTOMER]);

        if(@request('search')['value']){
            $value = request('search')['value'];
            return $q->whereRaw("concat(name, ' ',email) like '%" . $value . "%' ");

        }
        return $q;
    }
    public function branch(){
        return $this->hasOne(Branch::class);
    }
    public function codes()
    {
        return $this->hasMany(Code::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
    public function activeCode()
    {
        $code = $this->codes()->where('expire_at', '>', Carbon::now())->orderByDesc('expire_at')->first();
        return $code;
    }
    public function getPhotoPathAttribute(){
        if($this->photo == 'blank.png'){
            return asset('assets/media/avatars/'.$this->photo);
        }
        return asset('storage/user-photos/'.$this->photo);
    }
}
