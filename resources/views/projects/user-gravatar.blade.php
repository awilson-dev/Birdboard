<div>
    <img src="{{ gravatar_url($user->email) }}" alt="{{ $user->name }}'s avatar"
        class="user-gravatar rounded-full w-8 mr-2">

    <div class="user-profile card">
        <div class="-mx-2 -my-3">
            <h1 class="text-sm text-default">{{ $user->name }} <span
                    class="text-muted">{{ $user->id == auth()->id() ? '(You)' : (($role ?? 'user') == 'owner' ? '(Owner)' : '') }}</span>
            </h1>

            <p class="text-xs text-muted">{{ $user->email }}</p>
        </div>
    </div>
</div>
