<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserHobbies;
use Illuminate\Support\Facades\DB;
use App\Models\HobbiesMaster;

class User extends Authenticatable
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
        'profile_pic',
        'gender',
        'password'
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
        'password' => 'hashed',
    ];


    //Insert Hobbies
    public function InsertHobbies($user_id, $data)
    {
        DB::transaction(function () use ($user_id, $data) {
            // Delete existing user hobbies if they exist
            $user_hobbies = UserHobbies::where('user_id', $user_id)->count();
            if ($user_hobbies > 0) {
                UserHobbies::where('user_id', $user_id)->delete();
            }

            // Insert new hobbies
            foreach ($data as $d) {
                $hobby = new UserHobbies;
                $hobby->user_id = $user_id;
                $hobby->hobbies_id = $d;
                $hobby->created_at = now();
                $hobby->save();
            }
        });
    }

    //relation ship for the get hobbies
    public function hobbies()
    {
        return $this->belongsToMany(HobbiesMaster::class, 'user_hobbies', 'user_id', 'hobbies_id');
    }
}
