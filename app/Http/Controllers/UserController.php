<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HobbiesMaster;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /* Define userRepository */

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hobbies = HobbiesMaster::where('is_active', '=', 1 )->pluck('name','id');
        return view('auth/register',compact('hobbies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->userRepository->create($validatedData);
        if($user){
            Auth::login($user);
            // Redirect to home page
            return redirect()->route('home')->with('success', 'You are now logged in.');
        }
        return redirect()->route('login')->with('error', 'User not found.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userRepository->find($id);
        $userHobbies = $user->hobbies->pluck('id')->toArray();
        $hobbies = HobbiesMaster::where('is_active', '=', 1 )->pluck('name','id');
        return view('auth/edit',compact('hobbies','user','userHobbies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $user = $this->userRepository->update($id,$validatedData);
        return redirect()->route('profile')->with('success', 'User data updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Profile Cantroller
     */
    public function profile(){
        $user_id = Auth::user()->id;
        $user = $this->userRepository->find($user_id);
        return view('auth/profile',compact('user','user_id'));
    }
}
