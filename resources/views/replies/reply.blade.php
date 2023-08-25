<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reply') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div> --}}
        <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-row justify-between">
                            <div>
                                <strong>{{ $post->user->name }}</strong> <br>
                                {{ '@' . $post->user->username }}
                            </div>
                            <div>
                                {{ $post->created_at }}
                                <br>
                                <div class="flex flex-row justify-around">
                                @can('update', $post)
                                    <div>
                                        <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('posts.destroy', $post->id) }}">Delete</a>
                                    </div>
                                @endcan
                                </div>
                            </div>
                        </div>
                        <div class="mx-4">
                            <br>
                            {{ $post->content }}
                            <br>
                            <br>
                        </div>
                        <div class="flex flex-row justify-between justify-items-start">
                            <div>
                                <a href="{{ route('posts.like', $post->id) }}">
                                    @if ($post->liked())
                                        <i class="fa-solid fa-heart"></i>
                                    @else
                                        <i class="fa-regular fa-heart"></i>
                                    @endif
                                </a>
                                &nbsp;{{ $post->likeCount }}
                            </div>
                            <div>
                                <a href="{{ route('posts.reply', $post->id) }}">
                                    <i class="fa-regular fa-comment"></i>
                                    &nbsp;
                                    {{ $replies_count }}
                                </a>
                            </div>
                            <div>
                                {{ "Reposts: " }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('reply.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            {{-- <x-input-label for="content" :value="__('New Post')" /> --}}
                            <x-text-input id="content" name="content" type="text" placeholder="Write a reply..." class="mt-1 block w-full"
                                required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" id="parent_id" name="parent_id" value="{{ $post->id }}">

                        <div class="flex justify-end items-center gap-4">
                            <x-primary-button>{{ __('Reply') }}</x-primary-button>

                            @if (session('status') === 'reply-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Reply Created.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($replies as $reply)
            <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex flex-row justify-between">
                            <div>
                                <strong>{{ $reply->user->name }}</strong> <br>
                                {{ '@' . $reply->user->username }}
                            </div>
                            <div>
                                {{ $reply->created_at }}
                                <br>
                                <div class="flex flex-row justify-around">
                                @can('update', $reply)
                                    <div>
                                        <a href="{{ route('reply.edit', $reply->id) }}">Edit</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('reply.destroy', $reply->id) }}">Delete</a>
                                    </div>
                                @endcan
                                </div>
                            </div>
                        </div>
                        <div class="mx-4">
                            <br>
                            {{ $reply->content }}
                            <br>
                            <br>
                        </div>
                        <div class="flex flex-row justify-between justify-items-start">
                            <div>
                                <a href="{{ route('reply.like', $reply->id) }}">
                                    @if ($reply->liked())
                                        <i class="fa-solid fa-heart"></i>
                                    @else
                                        <i class="fa-regular fa-heart"></i>
                                    @endif
                                </a>
                                &nbsp;{{ $reply->likeCount }}
                            </div>
                            <div>
                                {{ "Replies: " }}
                            </div>
                            <div>
                                {{ "Reposts: " }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
