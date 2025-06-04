<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ $posts->total() }} {{ Str::plural('post', $posts->total()) }} encontrados
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="GET" action="{{ route('posts.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Filtrar por autor</label>
                                <select id="user_id" name="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Todos los autores</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Buscar por título o contenido..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                    Filtrar
                                </button>
                                @if(request()->has('user_id') || request()->has('search'))
                                    <a href="{{ route('posts.index') }}" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Limpiar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de posts -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($posts->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay posts</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if(request()->has('user_id') || request()->has('search'))
                                No se encontraron posts que coincidan con los filtros seleccionados.
                            @else
                                Aún no hay publicaciones disponibles.
                            @endif
                        </p>
                    </div>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach($posts as $post)
                            <li class="hover:bg-gray-50">
                                <a href="{{ route('posts.show', $post) }}" class="block">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <p class="text-lg font-medium text-indigo-600 truncate">
                                                {{ $post->title }}
                                            </p>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $post->comments()->count() }} {{ Str::plural('comentario', $post->comments()->count()) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:flex sm:justify-between">
                                            <div class="sm:flex">
                                                <p class="flex items-center text-sm text-gray-500">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                    </svg>
                                                    <a href="{{ route('users.show', $post->user) }}" class="text-indigo-600 hover:text-indigo-900">
                                                        {{ $post->user->name }}
                                                    </a>
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $post->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-600 line-clamp-2">
                                                {{ $post->body }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    <!-- Paginación -->
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $posts->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
