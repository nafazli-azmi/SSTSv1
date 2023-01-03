@extends('layouts.admin')

@section('title')
Edit Student
@endsection

@section('content')
<section class="content">
    <div class="">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Student</h4>
                    </div>
                    <div class="card-body">
                        <div>

                            <div>
                            <form class="form-horizontal" method="POST" action="{{ route('user.postProfile') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- name -->
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"  id="name" class="form-control @error('email') is-invalid @enderror" value="{{$student->name}}" required placeholder="Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- email -->
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{$student->email}}" placeholder="E-mail Address">
                                                @error('siteemail')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- svname -->
                                            <div class="form-group">
                                                <label for="svname">SV name</label>
                                                <input type="text" name="svname"  id="svname" class="form-control @error('name') is-invalid @enderror" value="{{$student->sv_name}}" placeholder="Supervisor Name">

                                           
                                            </div>
                                            <div class="form-group">                                
                                            <label>Select</label>
                                            <select class="form-control" name="svname">
                                                @foreach($svs as $sv)
                                                <option value="{{$sv->id}}">{{$sv->name}}</option>


                                                @endForeach 
                                            </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" placeholder="E-mail Address">
                                                @error('siteemail')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> -->
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