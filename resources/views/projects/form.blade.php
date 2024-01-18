@csrf

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Title</label>

    <div class="control">
        <input type="text" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full"
            name="title" placeholder="Title" required value="{{ $project->title }}">
    </div>
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="description">Description</label>

    <div class="control">
        <textarea name="description" class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-full"
            style="min-height: 150px" required>{{ $project->description }}</textarea>
    </div>
</div>

<div class="field mb-6">
    <div class="control">
        <button type="submit" class="button">{{ $buttonText }}</button>

        <a href="{{ $project->path() }}" class="text-gray-400 text-sm underline ml-3">Cancel</a>
    </div>
</div>

@if ($errors->any())
    <div class="field mt-4">
        @foreach ($errors->all() as $error)
            <li class="text-sm text-red-500">{{ $error }}</li>
        @endforeach
    </div>
@endif
