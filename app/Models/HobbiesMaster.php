<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class HobbiesMaster extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hobbies_master';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_hobbies', 'hobbies_id', 'user_id');
    }
}
