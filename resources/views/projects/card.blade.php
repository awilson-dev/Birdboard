<div class="card flex flex-col" style="height: 200px">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-accent pl-4">
        <a href="{{ $project->path() }}" class="text-default no-underline">{{ $project->title }}</a>
    </h3>

    <div class="text-muted mb-4 flex-1">{{ Str::limit($project->description, 100) }}</div>

    @can('manage', $project)
        {{-- <footer>
            <form method="POST" action="{{ $project->path() }}" class="text-right">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-xs hover:underline">Delete</button>
            </form>
        </footer> --}}

        <footer class="text-right">
            <button class="text-xs hover:underline" onclick="showModal('delete-project-{{ $project->id }}')">Delete</button>
        </footer>

        <x-modal id="delete-project-{{ $project->id }}" class="p-6 w-min">
            <h1 class="text-lg text-center mb-2 whitespace-nowrap">Are you sure you want to delete this project?</h1>

            <p class="text-sm mb-4 text-muted">"{{ $project->title }}" will be lost forever.</p>
        
            <footer class="mt-auto flex justify-end">
                <button class="button mr-4 is-outlined" onclick="closeModal('delete-project-{{ $project->id }}')">Cancel</button>

                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="button warning">Delete</button>
                </form>
            </footer>
        </x-modal>
    @endcan
</div>
