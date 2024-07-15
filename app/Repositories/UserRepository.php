<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->with('hobbies')->find($id);
    }

    public function create(array $data)
    {
        if(isset($data['id']) && !empty($data['id'])){
            $user = $this->find($id);
            if(empty($user)){
                $user = new $this->model;
            }
        }else{
            $user = new $this->model;
        }

        if (isset($data['profile_pic']) && !empty($data['profile_pic'])) {
            $imagepath = ImageHelper::storeImage($data['profile_pic'], 'profile_image');
            
            $user->profile_pic = $imagepath;
        }
       
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->gender = $data['gender'];
        $user->save();

        if ($user->id && isset($data['hobbies'])) {
            // Assuming the InsertHobbies method is part of the User model
            $user->InsertHobbies($user->id, $data['hobbies']);
        }
        return $user;
    }

    public function update($id, array $data)
    {
      
        $user = $this->model->find($id);
        //dd($data['profile_pic']);
        if (isset($data['profile_pic']) && !empty($data['profile_pic'])) {
            $imagepath = ImageHelper::storeImage($data['profile_pic'], 'profile_image');
            
            $user->profile_pic = $imagepath;
        }
        if ($user) {
            $user->name = $data['name'];
            $user->email = $data['email'];
          
            $user->gender = $data['gender'];
            $user->save();
            if ($user->id && isset($data['hobbies'])) {
                // Assuming the InsertHobbies method is part of the User model
                $user->InsertHobbies($user->id, $data['hobbies']);
            }
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
