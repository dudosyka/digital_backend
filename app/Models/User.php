<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function reg($data) {
        return User::create($data);
    }

    public static function auth($login, $password): bool|string
    {
        $user = User::query()->where('login', '=', $login)->where('password', '=', $password)->get()->all();
        if (count($user) > 0) {
            $user = $user[0];
            $token = Str::random(32);
            $token = hash('sha256', $token);
            User::query()->where('id', '=', $user->id)->update(['api_token' => $token]);
            return $token;
        } else {
            return false;
        }
    }
}
