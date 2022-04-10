<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware("auth");
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * get ALL USER - User index - vue
     */
    public function getAll(){
        $users = User::latest()->get();
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames(); 
            return $user;
        });

        return response()->json([ 
            'users' => $users
        ], 200);
    }

    public function getLects(){
        $users = User::role('SUPERVISOR')->get();
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames(); 
            return $user;
        });

        return response()->json([ 
            'users' => $users
        ], 200);
    }

    public function getStuds(){
        $users = User::role('STUDENT')->get();
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames(); 
            return $user;
        });

        return response()->json([ 
            'users' => $users
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|alpha_num|min:8',
            'role' => 'nullable',
            'cluster' => 'nullable',
            'email' => 'required|email|unique:users',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->cluster_id = $request->cluster;
        $user->assignRole($request->role);

        if($request->has('permissions')){
            $user->givePermissionTo($request->permissions);
        }

        //
        dd($request->role);

        $user->save();

        return response()->json("User Created", 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'nullable|alpha_num|min:8',
            'role' => 'required',
            'cluster' => 'required',
            'email' => 'required|email|unique:users,email,'.$id //validate email against other users
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->cluster_id = $request->cluster;

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        if($request->has('role')){                  //get new role
            $userRole = $user->getRoleNames();
            foreach($userRole as $role){            //remove old role
                $user->removeRole($role);
            }
            $user->assignRole($request->role);      //assign new role
        }

        if($request->has('permissions')){                  //get new role
            $userPermissions = $user->getPermissionNames();
            foreach($userPermissions as $permission){            //remove old role
                $user->revokePermissionTo($permission);
            }
            $user->givePermissionTo($request->permissions);      //assign new role
        }
        
        $user->save();

        return response()->json("User Updated",200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/////////USER DEFINE METHOD

public function profile(){
    return view("profile.index"); 
}

public function postProfile(Request $request){
    $user = auth()->user();
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$user->id
    ]);

    $user->update($request->all());

    return redirect()->back()->with('success','Profile Updated Successfully');
}

public function postPassword(Request $request){
    $this->validate($request, [
        'newpassword' => 'required|alpha_num|min:8|confirmed'
    ]);

    $user = auth()->user();
    $user-> update([
        'password' => bcrypt($request->newpassword)
    ]);

    return redirect()->back()->with('success', 'Password Successfully Changed');
}

public function delete($id){
    $user = User::findOrFail($id);

    $user->delete();

    return response()->json('user deleted',200);

}

public function search(Request $request){
    $searchWord = $request->get('s');
    $users =User::where(function($query) use ($searchWord){
        $query->where('name', 'LIKE', "%$searchWord%")->
        orWhere('email', 'LIKE', "%$searchWord%");
    })->latest()->get();

    $users->transform(function($user){
        $user->role = $user->getRoleNames()->first();
        $user->userPermissions = $user->getPermissionNames(); 
        return $user;
    });

    return response()->json([
        'users' => $users
    ], 200);
}

}
