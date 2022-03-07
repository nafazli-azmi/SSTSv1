@extends('layouts.admin')
 
@section('title')
Roles
@endsection

@section('content')
<div class="card">
    <div class="card-header" > 
        <h3 class="card-title">
            <i class="fas fa-user-tie" style="color: #339af0;"></i>
            Roles Table
        </h3>
        <div class="card-tools">
            <a href="{{ route('role.create') }} " class="btn btn-primary"><i class="fas fa-shield-alt"></i> Add new Role</a>
        </div>
    </div>
    <div class="card-body table-responsive p-1">
        <table class="table table-bordered text-nowrap">
            <thead class="bg-info text-white">
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Action</th>
                    <th>Date Posted</th>
                    
                </tr>
            </thead>
            <tbody style="background-color: #eeedf0;">
                @forelse ($roles as $role )
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission )
                                <button class="btn btn-warning" role="button"><i class="fas fa-shield-alt"></i> {{ $permission->name }}</button>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('role.destroy',$role->id ) }}" class="btn btn-danger">Delete</a>
                        </td> 
                        <td><span class="tag tag-success">{{ $role->created_at }}</span></td>

                    </tr>
                @empty
                    <tr>
                        <td><i class="fas fa-folder-open"></i> No Record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection