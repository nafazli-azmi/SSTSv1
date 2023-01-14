<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cluster;
use App\Models\Svby;
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
        $svs = User::latest()
        ->where('role_id',2)
        ->get();
        
    // $students = User::latest()
    //     ->where('role_id',3)
    //     ->get();            
    $students = Svby::latest()
        ->select('student_id','sv_id')
        ->get();
    
    $this->count = 1;
    $students->transform(function($student){
            $student->name = User::find($student->student_id)->name;
            $student->cluster_id = User::find($student->student_id)->cluster_id;
            $student->cluster_name = Cluster::find($student->cluster_id)->name;
            $student->sv_name = User::find($student->sv_id)->name;
            $student->created_at =User::find($student->student_id)->created_at;
            $student->no = $this->count++;                    
            return $student;
        });



        //   dd($students);

        return view('stud.index', 
        ['students' => $students]
        );
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
    public function edit($id)
    {
         $svs = User::latest()
         ->where('role_id',2)
         ->get();
        
     $studentname = User::find($id)->name;

     $student = Svby::first()
         ->where('student_id', $id)
         ->select('student_id','sv_id')

         ->get();
    
        $svname;

    $student->transform(function($student){
         $student->studentid = $student->student_id;

         $student->name = User::find($student->student_id)->name;
         $student->email = User::find($student->student_id)->email;
         $student->cluster_id = User::find($student->student_id)->cluster_id;
         $student->cluster_name = Cluster::find($student->cluster_id)->name;
         $student->sv_name = User::find($student->sv_id)->name;
     
         $student->created_at =User::find($student->student_id)->created_at;
         return $student;
         });

    $student->transform(function($student){
        $this->svname =$student->sv_name;
        return $this->svname;
    });

        return view("stud.edit",
            [
            'student' => $studentname,
            'svs' => $svs,
            'svname' => $this->svname
            ]
        );
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
        $this->count = 3;
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames();
            $user->cluster_id = Cluster::find($user->cluster_id)->name;

            $user->newid = $this->count++;
            return $user;
        });


        $users->transform(function($user){
            return $user;
        });

        return response()->json([ 
            'users' => $users
        ], 200);
    }
}
