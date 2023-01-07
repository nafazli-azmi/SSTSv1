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
        

    // $students = User::latest()
    //     ->where('role_id',3)
    //     ->get();            
     $students = Svby::first()
         ->where('student_id', $id)
         ->select('student_id','sv_id')

         ->get();
    
   // $this->count = 1;
//    $svt->transform(function($svt){
//     $svt->studentid = $svt->student_id;

//     $svt->name = User::find($svt->studentid)->name;
//     $svt->email = User::find($svt->student_id)->email;
//     $svt->cluster_id = User::find($svt->student_id)->cluster_id;
//     $svt->cluster_name = Cluster::find($svt->cluster_id)->name;
//     $svt->sv_name = User::find($svt->sv_id)->name;
//     $svt->created_at =User::find($svt->student_id)->created_at;
//     // $student->no = $this->count++;     
//     return $svt;
//     });    
    
    
    
    //dd($svt);
    
    
 $students->transform(function($student){
         $student->studentid = $student->student_id;

         $student->name = User::find($student->student_id)->name;
        $student->email = User::find($student->student_id)->email;
         $student->cluster_id = User::find($student->student_id)->cluster_id;
         $student->cluster_name = Cluster::find($student->cluster_id)->name;
         $student->sv_name = User::find($student->sv_id)->name;
         $student->created_at =User::find($student->student_id)->created_at;
         // $student->no = $this->count++;     
         return $student;
         });

      //  dd($students);
//   foreach ($students as $student) {
//     if ($student->studentid == $id) {
//         $this->student1 = $student;

//         dd($student1);

//         return $this->student1;
//     }else {
        
//     }
//   };

// array_where($students, find ($student, $studentid) {
//     $student;
// });

       // dd($students);


        //for foute edit only
        // $students->transform(function($student){
        // $student1 = $student->student_id == $this->id;
                   
        //     return $student1;
        // });
        //$student1 = $students::first($student->student_id, $id)->get();


       // dd($students[$id]);
        // $student = User::findOrFail($id);
        // $student->cluster_name = Cluster::find($student->cluster_id)->name;
        // //    $student->sv_name = User::find($student->sv_id)->name;
        // $student->sv_name = User::find($student->sv_id)->name;

                    
     
        
        // $svs;
        // $svs->sv_id = Svby::select('sv_id')->where('student_id','=',$id)
        // ->first();
        // $student = User::findOrFail($id);
        // $student->sv_id = $svs->sv_id;

       // $student->sv_id = Svby::get();
        // $student->sv_id = Svby::latest()
        //                         ->where('student_id',$id)
        //                         ->get();
       // dd($student);
        return view("stud.edit",
            [
           //  'student' => $students[$id],
             'student' => $students,
                // 'student' => array_where($students, select ($id, $studentid) {
                //     return $value
                // });,
            //    'svt' => $svt,
                'svs' => $svs
                
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
//aplha      //  $this->sv_id = 1;
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames();
            $user->cluster_id = Cluster::find($user->cluster_id)->name;

        //    $user->sv_id = Svby::first()->select('sv_id')->where('student_id', $user->id)->get();
        //    $user->sv_name = User::first()->select('name')->where('id', $user->sv_id)->get();

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
