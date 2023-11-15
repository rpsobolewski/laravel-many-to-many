@extends('layouts.admin.app')

@section('content')
<div class="container">

    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">Hello {{ Auth::user()->name }}!</div>

                <div class="card-body d-flex justify-content-center">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card text-center m-1" style="width: 18rem;">
                        <h1 class="bg-light p-4">{{$total_projects}}</h1>
                        <div class="card-body">
                            <h5 class="card-title">Projects</h5>
                            <p class="card-text"></p>
                            <a href="admin/projects" class="btn btn-primary">Go to projects</a>
                        </div>
                    </div>
                    <div class="card text-center m-1" style="width: 18rem;">
                        <h1 class="bg-light p-4">{{$total_users}}</h1>
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection