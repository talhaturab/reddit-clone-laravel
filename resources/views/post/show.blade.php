<x-app-layout>
    <div>
        <a href="/" class="flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="ml-2">All ideas</span>
        </a>
    </div>

    <livewire:post-show
        :post="$post"
        :likesCount="$likesCount"
    />

    <livewire:post-comments 
        :post="$post"
    />

    @can('delete', $post)
    <livewire:delete-post
        :post="$post"
    />
    @endcan

    @can('update', $post)
    <livewire:edit-post
        :post="$post"
    />
    @endcan

    @auth
    <livewire:edit-comment />
    @endauth

    @auth
    <livewire:delete-comment />
    @endauth


</x-app-layout>