<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('comments.index') }}" class="text-indigo-600 hover:text-indigo-800">Comentarios</a>
                <span class="text-gray-500 mx-2">/</span>
                Detalle del comentario
            </h2>
            <div class="text-sm text-gray-500">
                {{ $comment->created_at->diffForHumans() }}
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Información del comentario -->
                <div class="px-6 py-5 border-b border-gray-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-xl font-semibold text-indigo-600">
                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $comment->name }}
                                </h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ $comment->email }}
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">
                                Comentó en 
                                <a href="{{ route('posts.show', $comment->post) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                    {{ $comment->post->title }}
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 whitespace-pre-line">{{ $comment->body }}</p>
                    </div>
                </div>
                
                <!-- Post relacionado -->
                <div class="px-6 py-5">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Post relacionado
                    </h3>
                    
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                    {{ strtoupper(substr($comment->post->user->name, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('users.show', $comment->post->user) }}" class="hover:underline">
                                            {{ $comment->post->user->name }}
                                        </a>
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $comment->post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            <h4 class="mt-3 text-lg font-semibold text-gray-900">
                                <a href="{{ route('posts.show', $comment->post) }}" class="hover:text-indigo-600">
                                    {{ $comment->post->title }}
                                </a>
                            </h4>
                            
                            <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                                {{ $comment->post->body }}
                            </p>
                            
                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                <svg class="h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                </svg>
                                {{ $comment->post->comments_count }} {{ Str::plural('comentario', $comment->post->comments_count) }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('posts.show', $comment->post) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Volver al post
                    </a>
                    <a href="{{ route('comments.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-500">
                        Ver todos los comentarios
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
