@extends('layouts.app')

@section('content')
    <div class="card lg:w-1/2 lg:mx-auto">
        <form method="POST" action="/projects" class="py-8 px-16">
            <h1 class="text-2xl font-normal mb-10 text-center">Let's start something new</h1>

            @include('projects.form', [
                'project' => new App\Models\Project(),
                'buttonText' => 'Create Project',
            ])
        </form>
    </div>
@endsection
