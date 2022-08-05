<div>
    <div class="comment-container relative bg-white rounded-xl flex mt-4 ml-14">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none">
                <a href="#">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full md:mx-4">
                {{-- <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline">A random title can go here</a>
                </h4> --}}
                <div class="text-gray-600 mt-3 line-clamp-3">
                    {{ $reply->body }}
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">{{ $reply->user->name }}</div>
                        <div>&bull;</div>
                        <div>{{ $reply->created_at->diffForHumans() }}</div>
                    </div>
                    <div
                        class="flex items-center space-x-2"
                        x-data="{ isOpen: false }"
                    >
                        <div class="relative">
                            <button
                                class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3"
                                @click="isOpen = !isOpen"
                            >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                            </button>
                            <ul
                                class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                x-cloak
                                x-show.transition.origin.top.left="isOpen"
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                            >
                                @can('update', $reply)
                                <li>
                                    <a
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setEditComment', {{ $reply->id }})
                                        "
                                        href="#"
                                        class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    >
                                        Edit Reply
                                    </a>
                                </li>
                                @endcan

                                @can('delete', $reply)
                                <li>
                                    <a
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setDeleteComment', {{ $reply->id }})
                                        "
                                        href="#"
                                        class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    >
                                        Delete Comment
                                    </a>
                                </li>
                                @endcan

                            </ul>
                        </div>
                    </div>
                </div>

                <livewire:add-reply
                    :comment="$reply"
                />

            </div>
        </div>
    </div>

    <div class="ml-14">
        <livewire:comment-replies 
            :comment="$reply"
        />
    </div>

</div>