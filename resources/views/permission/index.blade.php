@extends('layouts.admin')

@section('title')
Permissions
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-lock" style="color: #339af0;"></i>
            Permission Table
        </h3>

        <div class="card-tools">    
            <a href="{{ route('permission.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Create New Permission</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table  table-striped">
            <thead class="bg-info text-white">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date Created</th>
  
                </tr>
            </thead>
            <tbody >
                @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at }}</td>
                    </tr>
                @empty
                    <tr>No Result Found</tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection