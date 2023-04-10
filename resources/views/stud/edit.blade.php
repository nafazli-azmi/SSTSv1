@extends('layouts.admin')

@section('title')
Edit Student
@endsection

@section('content')
<section class="content">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary"  >
                        <h4>Edit Student</h4>
                    </div>
                    <div class="card-body" >
                        <div>

                            <div > <!-- form -->

                                <form class="form-horizontal" method="POST" action="{{ route('user.postProfile') }}">
  
                                    <font size="+2">Student name:</font>
                                    
                                            <h3>{{$student}}</h3>

                            <br></br>
                        
                                Current SV's name:
                                <h3>{{$svname}}</h3>
                            

                            <div class="form-group">                                
                                <label>Select</label>
                                <select class="form-control" name="svname">
                                    <option value="">Choose SV</option>
                                    @foreach($svs as $sv)
                                    <option value="{{$sv->id}}">{{$sv->name}}</option>


                                    @endForeach 
                                </select>
                            </div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text">Student's Name</span>
                                </div>
                                <input type="text" class="form-control" placeholder={{$student}} disabled>
                                </div>
                            </div>
                                            
                            </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Update Profile</button>
                                        <!-- <a role="button" href="admin/index.html" class="bizwheel-btn theme-2">Login</a> -->
                                    </div>
                                </div>
                            </div>
                            </form> 

                            </div>


                        </div>
                            
                    </div>
                </div> <!--edit profile-->
            </div> <!--body-->
        </div>
    </div>
</section>

@endsection