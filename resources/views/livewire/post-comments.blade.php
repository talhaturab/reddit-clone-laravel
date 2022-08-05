<div class="comments-container relative space-y-6 md:ml-22 pt-4 my-8 mt-1">
    <div>
        @foreach ($comments as $comment)
            <livewire:post-comment
                :key="$comment->id"
                :comment="$comment"
            />    
        @endforeach
    </div>
</div> <!-- end comments-container -->