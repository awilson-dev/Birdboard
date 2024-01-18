@extends('layouts.app')

@section('content')
    <div class="card lg:w-1/2 lg:mx-auto">
        <form method="POST" action="{{ $project->path() }}" class="py-8 px-16">
            <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>

            @method('PATCH')
            @include('projects.form', [
                'buttonText' => 'Update Project',
            ])
        </form>
    </div>
@endsection
