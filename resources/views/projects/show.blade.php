@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-muted text-sm font-normal">
                <a href="/projects" class="no-underline">My Projects</a> /
                {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    @include('projects.user-gravatar', ['user' => $member])
                @endforeach

                @include('projects.user-gravatar', ['user' => $project->owner, 'role' => 'owner'])

                {{-- <a href="{{ $project->path() }}/edit" class="button ml-4">Edit Project</a> --}}
                <button class="button ml-4" onclick="showModal('edit-project')">Edit Project</button>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-muted font-normal mb-3">Tasks</h2>

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="flex items-center">
                                    <input name="body" value="{{ $task->body }}"
                                        class="bg-card w-full -m-3 p-3 mr-5 {{ $task->completed ? 'text-muted line-through' : 'text-default' }}"
                                        autocomplete="off">

                                    <div>
                                        <input name="completed" type="checkbox"
                                            class="size-6 appearance-none border border-muted rounded-md checked:bg-button cursor-pointer"
                                            onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>

                                        <svg class="color-white relative bottom-7 left-1 -mb-5 {{ $task->completed ? 'fill-white' : 'fill-none' }}"
                                            style="pointer-events: none" height="17" width="15"
                                            viewBox="0 0 448 412">
                                            <path
                                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf

                            <input placeholder="Add a new task..." class="bg-card text-default w-full -m-3 p-3"
                                name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-muted font-normal mb-3">General Notes</h2>

                    <form method="POST" action="{{ $project->path() }}">
                        @method('PATCH')
                        @csrf

                        <textarea name="notes" class="card w-full mb-4" style="min-height: 200px"
                            placeholder="Anything special that you want to make a note of?">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>

                    @include('errors')
                </div>
            </div>

            <div class="lg:w-1/4 px-3 lg:py-10">
                @include('projects.card')
                @include('projects.activity.card')

                @can('manage', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>

    <x-modal id="edit-project" class="p-10 lg:w-1/2 text-default">
        <edit-project-modal
            project='{"title":"{{ $project->title }}", "description":"{{ $project->description }}", "id":"{{ $project->id }}"}'></edit-project-modal>
    </x-modal>
@endsection
