@extends('layouts.app')

@section('content')
    <div class="card lg:w-1/2 lg:mx-auto">
        <form method="POST" action="/projects" class="py-8 px-16">
            @csrf

            <h1 class="text-2xl font-normal mb-10 text-center">Let's start something new</h1>

            <div class="field mb-6">
                <label class="label text-sm mb-2 block" for="title">Title</label>

                <div class="control">
                    <input type="text" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                        name="title" placeholder="Title">
                </div>
            </div>

            <div class="field mb-6">
                <label class="label text-sm mb-2 block" for="description">Description</label>

                <div class="control">
                    <textarea name="description" class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-full"
                        style="min-height: 150px"></textarea>
                </div>
            </div>

            <div class="field mb-6">
                <div class="control">
                    <button type="submit" class="button">Create Project</button>

                    <a href="/projects" class="text-gray-400 text-sm underline ml-3">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
