<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'PhoneNumber',
        'governote',
        'role',
        'img',
        'city',
        'description',
        'id'
    ];
    protected $primaryKey='id';
    public $incrementing=false;

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

//    public function sendPasswordResetNotification($token)
//    {
//
//        $url = 'https://spa.test/reset-password?token=' . $token;
//
//        $this->notify(new ResetPasswordNotification($url));
//    }



    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
//    public function sendPasswordResetNotification($token)
//    {
//        $url = 'http://127.0.0.1:8000/api/auth/reset-password?token='.$token.'?email=your_email_here?password=new_password?password_confirmation=again';
//
//        $this->notify(new ResetPasswordNotification($url));
//    }
}
