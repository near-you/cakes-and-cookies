<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'role',
        'email',
        'shop_id',
        'email_verified_at',
        'password',
        'img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public static function createUser($request)
    {
        if ($files = $request->file('img')) {
            $imgName =  Auth::id() . "_" . time() . "." . $files->getClientOriginalExtension();
            $files->storeAs(
                'public/user_img', $imgName
            );
        }
        $data = $request->all();
        $data['img'] = $imgName;
        $data['role'] = lcfirst($request->role);
        $data['password'] = Hash::make($request->password);
        return User::create($data);
    }
}
