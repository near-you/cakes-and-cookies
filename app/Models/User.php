<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public static function imgName($files): string
    {
        return Auth::id() . "_" . time() . "." . $files->getClientOriginalExtension();
    }

    public static function createUser($request)
    {
        $data = $request->all();

        if ($files = $request->file('img')) {
            $imgName = User::imgName($files);
            $data['img']->move(Storage::path('public/user_img/') . 'origin/', $imgName);
            $thumbnail = Image::make(Storage::path('public/user_img/') . 'origin/' . $imgName);
            $thumbnail->fit(128, 128);
            $thumbnail->save(Storage::path('public/user_img/') . 'thumbnail/' . $imgName);
        }

        $data['img'] = $imgName;
        $data['role'] = lcfirst($request->role);
        $data['password'] = Hash::make($request->password);
        return User::query()->create($data);
    }

    public static function updateUser(int $id, $request): int
    {
        $data = $request->except(['_token', '_method', 'password_confirmation']);
        if ($files = $request->file('img')) {
            self::imgDestroy($id);
            $imgName = User::imgName($files);
            $data['img']->move(Storage::path('public/user_img/') . 'origin/', $imgName);
            $thumbnail = Image::make(Storage::path('public/user_img/') . 'origin/' . $imgName);
            $thumbnail->fit(128, 128);
            $thumbnail->save(Storage::path('public/user_img/') . 'thumbnail/' . $imgName);
            $data['img'] = $imgName;
        }

        return User::query()->where('id', $id)
            ->update($data);
    }

    public static function imgDestroy(int $id)
    {
        if(User::query()->find($id)->img) {
            if (file_exists(Storage::path('public/user_img/') . 'origin/' . User::query()->find($id)->img)) {
                unlink(Storage::path('public/user_img/') . 'origin/' . User::query()->find($id)->img);
            }
            if (file_exists(Storage::path('public/user_img/') . 'thumbnail/' . User::query()->find($id)->img)) {
                unlink(Storage::path('public/user_img/') . 'thumbnail/' . User::query()->find($id)->img);
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
