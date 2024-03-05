<div class="card mt-3">
    <div class="text-xs list-reset">
        @foreach ($project->activity as $activity)
            <div class="{{ $loop->last ? '' : 'mb-1' }} flex justify-between">
                <span class="break-words overflow-hidden">@include("projects.activity.{$activity->description}")</span>

                <span class="text-muted whitespace-nowrap ml-2">{{ $activity->created_at->diffForHumans(null, null, true) }}</span>
            </div>
        @endforeach
    </div>
</div>
