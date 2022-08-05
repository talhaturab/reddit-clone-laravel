<div class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl @if($hasLiked) text-blue @endif">{{ $likesCount }}</div>
            <div class="text-gray-500">Likes</div>
        </div>

        <div class="mt-8">
            @if ($hasLiked)
                <button wire:click.prevent="createLike" class="w-20 text-white bg-blue font-bold text-xxs uppercase rounded-xl px-4 py-3 border border-blue hover:bg-blue-hover transition duration-150 ease-in">Liked</button>
            @else
                <button wire:click.prevent="createLike" class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl px-4 py-3 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in">Like</button>
            @endif
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $post->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{ route('post.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                {{ $post->description }}
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div>{{ $post->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div wire:ignore class="text-gray-900">{{ $post->comments_count }} Comments</div>
                </div>
                
                <div class="flex items-center md:hidden mt-4 md:mt-0">
                    <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none">12</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                    </div>
                    <button
                        class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5"
                    >
                        Vote
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end idea-container -->