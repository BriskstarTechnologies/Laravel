<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHobbies extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hobbies_id'
    ];
     
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_hobbies';
}
