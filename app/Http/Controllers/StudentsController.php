<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $users = User::role('STUDENT')->get();
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames(); 
            return $user;
        });
        return view('stud.index', ['users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students)
    {
        //
    }

    public function getStudents(){
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
}
