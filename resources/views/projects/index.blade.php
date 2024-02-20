@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-muted text-sm font-normal">My Projects</h2>

            {{-- <a href="/projects/create" class="button">New Project</a> --}}
            <button class="button" onclick="showModal('new-project')">New Project</button>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>

    {{-- @include('projects.modal', [
        'id' => 'new-project',
        'file' => 'projects.create',
    ]) --}}

    {{-- @include('projects.new-project-modal') --}}
    <x-modal id="new-project" class="p-10 lg:w-1/2 text-default">
        <new-project-modal></new-project-modal>
    </x-modal>
@endsection
