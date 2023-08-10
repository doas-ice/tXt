<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('posts.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            {{-- <x-input-label for="content" :value="__('New Post')" /> --}}
                            <x-text-input id="content" name="content" type="text" placeholder="Write Something..." class="mt-1 block w-full"
                                required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Post') }}</x-primary-button>

                            @if (session('status') === 'post-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Post Created.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($posts as $post)
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
                            </div>
                        </div>
                        <br>
                        {{ $post->content }}
                        <br>
                        <br>
                        <div class="flex flex-row justify-between justify-items-start">
                            <div>
                                {{ "Likes: ". $post->likes }}
                            </div>
                            <div>
                                {{ "Replies: ". $post->replies }}
                            </div>
                            <div>
                                {{ "Reposts: ". $post->reposts }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
