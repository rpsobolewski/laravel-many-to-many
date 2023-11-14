@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>ADMIN/PROJECTS/SHOW.BLADE</h1>
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Project Details for') }} {{ Auth::user()->name }}.
    </h2>
    <h3 class="fs-5 text-secondary">
        {{ __('Showing Project') }} ID: {{ $project->id }}
    </h3>

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        {{ session('status') }}
    </div>
    @endif

    <div class="row justify-content-center my-3">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $project->title }}</h5>
                </div>


                <img class="img-fluid" style="height: 400px" src="{{ $project->thumb }}" alt="{{ $project->title }}">


                <div class="card-body">
                    <p><strong>Description: </strong>{{ $project->description }}</p>


                </div>
                <p><strong>Technologies used:</strong></p>

                <div class="d-flex">
                    <ul class="d-flex gap-2 list-unstyled">
                        @forelse ($project->technologies as $technology)
                        <li class="badge bg-success">
                            <i class="fa-solid fa-code"></i> {{ $technology->name }}
                        </li>
                        @empty
                        <li class="badge bg-secondary"><i class="fa-regular fa-file"></i> None/Others</li>
                        @endforelse
                    </ul>
                </div>

                <p><i class="fa-brands fa-github"></i> {{ $project->github }}</p>
                <p><i class="fa-solid fa-link"></i> {{ $project->link }}</p>
            </div>
            <a type="button" class="btn btn-primary mt-1" href="{{ route('admin.projects.edit', $project->slug) }}">Edit</a>
            @include('partials.delete')
        </div>
    </div>

</div>
@endsection