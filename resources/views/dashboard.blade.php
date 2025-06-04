<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Bienvenido al Panel de Administración</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <!-- Usuarios -->
                        <div class="bg-indigo-50 p-6 rounded-lg shadow">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-gray-700 font-semibold">Usuarios</h4>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
                                    <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Ver todos →</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Posts -->
                        <div class="bg-blue-50 p-6 rounded-lg shadow">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-gray-700 font-semibold">Posts</h4>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Post::count() }}</p>
                                    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Ver todos →</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comentarios -->
                        <div class="bg-green-50 p-6 rounded-lg shadow">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-gray-700 font-semibold">Comentarios</h4>
                                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Comment::count() }}</p>
                                    <a href="{{ route('comments.index') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">Ver todos →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-12">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones Rápidas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('users.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center">
                                <div class="p-2 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 3 0 016 3H2a6 3 0 016-3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Ver todos los usuarios</h4>
                                    <p class="text-sm text-gray-500">Explora la lista completa de usuarios</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('posts.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center">
                                <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Explorar posts</h4>
                                    <p class="text-sm text-gray-500">Lee las últimas publicaciones</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('comments.index') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center">
                                <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-2v2a2 2 0 01-2 2H8a2 2 0 01-2-2v-2H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM8 8a1 1 0 100-2 1 1 0 000 2zm4 0a1 1 0 100-2 1 1 0 000 2zm-4 4a1 1 0 100-2 1 1 0 000 2zm4 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Moderar comentarios</h4>
                                    <p class="text-sm text-gray-500">Revisa los últimos comentarios</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('download.user-comments') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center" download>
                                <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Descargar estadísticas</h4>
                                    <p class="text-sm text-gray-500">user_comment_counts.json</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
