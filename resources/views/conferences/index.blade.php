<x-app-layout>
    <x-slot name="header">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conferences') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <a href="#" onClick="favoriteConference(); return false">Favorite #1</a>
        <a href="#" onClick="unfavoriteConference(); return false">Un-favorite #1</a>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul class="list-disc pl-4">
                        @foreach ($conferences as $conference)
                            <li>
                                @if (Auth::user()->favoritedConferences->pluck("id")->contains($conference->id))
                                    <a href="{{ route("conferences.unfavorite", ["conference" => $conference]) }}">*</a>
                                @else
                                    <a href="{{ route("conferences.favorite", ["conference" => $conference]) }}">0</a>
                                @endif
                            
                                <a href="{{ route('conferences.show', ["conference" => $conference]) }}" class="hover:underline">{{ $conference->title }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        function favoriteConference() {
            fetch("/conferences/1/favorite", {
                method: "POST",
                headers: {
                    "Content-type": "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
                }
            });
        }

        function unfavoriteConference() {
            fetch("/conferences/1/unfavorite", {
                method: "DELETE",
                headers: {
                    "Content-type": "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
                }
            });
        }
    </script>
</x-app-layout>
