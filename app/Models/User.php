<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $data = $request->all();

        if ($files = $request->file('img')) {
            $imgName = Auth::id() . "_" . time() . "." . $files->getClientOriginalExtension();
            $data['img']->move(Storage::path('public/user_img/') . 'origin/', $imgName);
            $thumbnail = Image::make(Storage::path('public/user_img/') . 'origin/' . $imgName);
            $thumbnail->fit(128, 128);
            $thumbnail->save(Storage::path('public/user_img/') . 'thumbnail/' . $imgName);
        }

        $data['img'] = $imgName;
        $data['role'] = lcfirst($request->role);
        $data['password'] = Hash::make($request->password);
        return User::create($data);
    }

    public static function updateUser(int $id, $request)
    {
        $data = $request->except(['_token', '_method', 'password_confirmation']);
        if ($files = $request->file('img')) {
            self::imgDestroy($id);
            $imgName = Auth::id() . "_" . time() . "." . $files->getClientOriginalExtension();
            $data['img']->move(Storage::path('public/user_img/') . 'origin/', $imgName);
            $thumbnail = Image::make(Storage::path('public/user_img/') . 'origin/' . $imgName);
            $thumbnail->fit(128, 128);
            $thumbnail->save(Storage::path('public/user_img/') . 'thumbnail/' . $imgName);
            $data['img'] = $imgName;
        }

        return User::where('id', $id)
            ->update($data);
    }

    public static function imgDestroy(int $id)
    {
        if(User::find($id)->img) {
            if (file_exists(Storage::path('public/user_img/') . 'origin/' . User::find($id)->img)) {
                unlink(Storage::path('public/user_img/') . 'origin/' . User::find($id)->img);
            }
            if (file_exists(Storage::path('public/user_img/') . 'thumbnail/' . User::find($id)->img)) {
                unlink(Storage::path('public/user_img/') . 'thumbnail/' . User::find($id)->img);
            }
        }
    }

    public static function userDestroy(int $id)
    {
        self::imgDestroy($id);
        User::destroy($id);
    }

    public static function redirectView(int $id, string $str): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('user.index')->with(
            'status',
            'User #' . $id. ' was' . $str);
    }
}
