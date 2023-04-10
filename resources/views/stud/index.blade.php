@extends('layouts.admin')

@section('title')
Student
@endsection

@section('content')
<div class="p-0">

            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{count($students)}}</h3>


                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
            </div>
          
          <!-- ./col -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" >
                        <i class="fas fa-user-tie" style="color: #20b2aa;"></i>    
                        STUDENTS
                    </h3>
                    </div>
                    
                    <div class="card-body table-responsive p-1">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Cluster</th>
                                        <th>Project Title</th>
                                        <!-- <th>Email</th> -->
                                        <th>SV Name</th>
                                        <th>Date Added</th>
                                        <th>Action</th>

                                    
                                    </tr>
                                </thead>
                                <tbody >
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>{{ $student->no }}</td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->cluster_name }}</td>
                                            <td>Project Title</td>
                                            <!-- <td>{{ $student->email }}</td> -->
                                            <td>{{ $student->sv_name }}</td>
                                            <td>{{ $student->created_at }}</td>
                                            <td>
                                                <div class="card-tools">    
                                                    <a href="{{ route('student.edit',['id'=> $student->student_id]) }}" class="btn btn-warning">
                                                    <i class="fas fa-plus-circle"></i>Edit User</a>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>No Result Found</tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

</div>
@endsection