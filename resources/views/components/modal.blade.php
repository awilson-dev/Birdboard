<div id="{{ $id }}-modal" class="modal-background hidden">
    <div class="fixed top-0 bottom-0 left-0 right-0 backdrop-blur-sm backdrop-brightness-75">
        <div {{-- class="modal card flex flex-col fixed top-0 bottom-0 left-0 right-0 mx-auto my-auto lg:w-1/2 w-fit h-fit shadow-lg p-10"> --}}
            {{ $attributes->merge(['class' => 'modal card flex flex-col fixed top-0 bottom-0 left-0 right-0 mx-auto my-auto w-fit h-fit shadow-lg']) }}>
            {{ $slot }}
        </div>
    </div>
</div>
