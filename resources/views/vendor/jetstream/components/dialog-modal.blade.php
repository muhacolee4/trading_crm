@props(['id' => null, 'maxWidth' => 100])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                </div>
                <div class="modal-body">
                    {{ $content }}
                </div>
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
</x-jet-modal>
