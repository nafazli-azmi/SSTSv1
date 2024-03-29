<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Svby;
use App\Models\Cluster;

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
        $this->count = 1;
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames(); 
            $user->newid = $this->count++;
            return $user;
        });

        return response()->json([ 
            'users' => $users
        ], 200);
    }

    public function getLects(){
        $users = User::role('SUPERVISOR')->get();
        $this->count = 1;
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames(); 
            $user->cluster_id = Cluster::find($user->cluster_id)->name;
            $user->newid = $this->count++;
            $user->nostu = Svby::select('student_id')->where('sv_id',$user->id)->count();
            return $user;
        });

        return response()->json([ 
            'users' => $users
        ], 200);
    }

    public function getStuds(){
        $users = User::role('STUDENT')->get();
        $this->count = 1;
//aplha      //  $this->sv_id = 1;
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames();
        //    $user->sv_id = Svby::first()->select('sv_id')->where('student_id', $user->id)->get();
        //    $user->sv_name = User::first()->select('name')->where('id', $user->sv_id)->get();
            $user->cluster_id = Cluster::find($user->cluster_id)->name;
          //  $this->sv_id = Svby::get("sv_id")->where('student_id',$user->id);

//alpha            $user->sv_id = $this->sv_id;
            
          //  $user->sv_name = User::find('name')->where('id',$this->sv_id)->get();
         //   $user->sv_name = User::find($this->sv_id)->name;

            $user->newid = $this->count++;
            return $user;
        });


        $users->transform(function($user){

        //    $user->svid = Svby::select('sv_id')->where('student_id',$user->id);
   //     $user->svid = Svby::where('student_id','=',$user->id)
     //                   ->first()->get('sv_id');
        
 //alpha          // $user->sv_name = User::find($this->sv_id)->name;
 //alpha          $user->sv_name = User::find($user->sv_id)->name;




           // $user->newid = $this->count++;
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


        if ($request->role == 1) {
            $user->givePermissionTo('Create User', 'Create Role', 'Create Permission', 'Create Report', 'Create Cluster', 'Create Category');
        } elseif ($request->role == 2) {
            $user->givePermissionTo('Create User', 'Create Meeting', 'Create Submission');
        } elseif ($request->role == 3) {
            $user->givePermissionTo('Create Progress', 'Create Meeting', 'Create Submission');
        }

        // if($request->has('permissions')){
        //     $user->givePermissionTo($request->permissions);
        // }

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
