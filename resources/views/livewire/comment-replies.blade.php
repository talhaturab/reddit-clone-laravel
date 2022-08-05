<div>
    <div>
        @foreach ($replies as $reply)
        <livewire:comment-reply
            :key="$reply->id"
            :reply="$reply"
        />
        @endforeach
    </div>
</div>
