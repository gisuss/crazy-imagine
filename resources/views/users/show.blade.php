<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-800">Usuarios</a>
                <span class="text-gray-500 mx-2">/</span>
                {{ $user->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center text-2xl font-bold text-indigo-600">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                        {{ $user->name }}
                                    </h1>
                                    <p class="mt-1 text-sm text-gray-500">
                                        @<span class="lowercase">{{ $user->username }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex lg:mt-0 lg:ml-4" style="display: none">
                            <span class="hidden sm:block">
                                <a href="mailto:{{ $user->email }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    Enviar email
                                </a>
                            </span>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h2 class="text-lg font-medium text-gray-900">Información del perfil</h2>
                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    <svg class="h-5 w-5 text-gray-400 inline-block mr-2 -mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    Dirección
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($user->address)
                                        {{ $user->address->street }}, {{ $user->address->suite }}<br>
                                        {{ $user->address->city }}, {{ $user->address->zipcode }}
                                    @else
                                        <span class="text-gray-400">No disponible</span>
                                    @endif
                                </dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    <svg class="h-5 w-5 text-gray-400 inline-block mr-2 -mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Contacto
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <div class="mb-1">
                                        <a href="mailto:{{ $user->email }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $user->email }}
                                        </a>
                                    </div>
                                    @if($user->phone)
                                        <div>
                                            <a href="tel:{{ $user->phone }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $user->phone }}
                                            </a>
                                        </div>
                                    @endif
                                    @if($user->website)
                                        <div class="mt-2">
                                            <a href="http://{{ $user->website }}" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $user->website }}
                                            </a>
                                        </div>
                                    @endif
                                </dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    <svg class="h-5 w-5 text-gray-400 inline-block mr-2 -mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v2H7V5zm0 4h6v2H7V9zm0 4h6v2H7v-2z" clip-rule="evenodd" />
                                    </svg>
                                    Compañía
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($user->company)
                                        <div class="font-medium">{{ $user->company->name }}</div>
                                        <div class="text-gray-500 italic">"{{ $user->company->catch_phrase }}"</div>
                                        <div class="mt-1 text-gray-700">{{ $user->company->bs }}</div>
                                    @else
                                        <span class="text-gray-400">No disponible</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Últimos posts -->
                    <div class="mt-12">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium text-gray-900">Últimos posts</h2>
                            <a href="{{ route('posts.index', ['user_id' => $user->id]) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Ver todos los posts
                            </a>
                        </div>
                        
                        @if($user->posts->isEmpty())
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay posts</h3>
                                <p class="mt-1 text-sm text-gray-500">Este usuario aún no ha publicado nada.</p>
                            </div>
                        @else
                            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                <ul class="divide-y divide-gray-200">
                                    @foreach($user->posts as $post)
                                        <li>
                                            <a href="{{ route('posts.show', $post) }}" class="block hover:bg-gray-50">
                                                <div class="px-4 py-4 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-indigo-600 truncate">
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
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                                </svg>
                                                                {{ $post->created_at->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
