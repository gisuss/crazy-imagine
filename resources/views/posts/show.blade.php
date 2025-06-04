<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:text-indigo-800">Posts</a>
                <span class="text-gray-500 mx-2">/</span>
                {{ Str::limit($post->title, 50) }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ $post->created_at->diffForHumans() }}
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Post -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                <a href="{{ route('users.show', $post->user) }}" class="hover:underline">
                                    {{ $post->user->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-500">
                                Publicado {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
                    
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $post->body }}</p>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="h-5 w-5 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                            {{ $post->comments()->count() }} {{ Str::plural('comentario', $post->comments()->count()) }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Comentarios -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">
                        Comentarios
                        @if($post->comments()->count() > 0)
                            <span class="text-sm font-normal text-gray-500">({{ $post->comments()->count() }})</span>
                        @endif
                    </h3>
                    
                    @if($post->comments()->count() == 0)
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay comentarios</h3>
                            <p class="mt-1 text-sm text-gray-500">Sé el primero en comentar.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($post->comments()->get() as $comment)
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-semibold">
                                            {{ strtoupper(substr($comment->email, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 bg-gray-50 rounded-lg px-4 py-3">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-sm font-semibold text-gray-900">{{ $comment->name }}</h4>
                                            <span class="text-xs text-gray-500">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-700">{{ $comment->body }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
