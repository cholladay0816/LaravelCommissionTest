<x-agnostic-layout>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($users as $user)
            <li class="hidden lg:flex col-span-1 flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                <a class="flex-1 flex flex-col pb-4" href="{{ url('creator/' . $user->name) }}">
                    <img class="w-72 h-72 flex-shrink-0 mx-auto rounded-lg" src="{{$user->profile_photo_url}}" alt="">
                    <h3 class="mt-6 text-gray-900 text-sm font-medium">{{$user->name}}</h3>
                    <dl class="mt-1 flex-grow flex flex-col justify-between">
                        <dt class="sr-only">Title</dt>
                        <dd class="text-gray-500 text-sm">Creator</dd>
                        <dt class="sr-only">Role</dt>
                        <dd class="mt-3">
                            <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">User</span>
                        </dd>
                    </dl>
                </a>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="w-0 flex-1 flex">
                            <a href="{{ route('creator.show', $user) }}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span class="ml-3">View</span>
                            </a>
                        </div>
                        <div class="-ml-px w-0 flex-1 flex">
                            <a href="{{ route('creator.show', [$user, 'commissions']) }}" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                <span class="ml-3">Commission</span>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="lg:hidden block col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
                        <div class="w-full flex items-center justify-between p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-gray-900 text-sm font-medium truncate">{{ $user->name }}</h3>
                                    <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">User</span>
                                </div>
                                <p class="mt-1 text-gray-500 text-sm truncate">Creator</p>
                            </div>
                            <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" src="{{ $user->profile_photo_url }}" alt="">
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="w-0 flex-1 flex">
                                    <a href="{{route('creator.show', $user)}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="ml-3">View</span>
                                    </a>
                                </div>
                                <div class="-ml-px w-0 flex-1 flex">
                                    <a href="{{route('creator.show', [$user, 'commissions'])}}" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                        <span class="ml-3">Commission</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
            @endforeach
            <!-- More items... -->
        </ul>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav class="mt-5 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $first }}</span>
                    to
                    <span class="font-medium">{{ $last }}</span>
                    of
                    <span class="font-medium">{{ $total }}</span>
                    results
                </p>
            </div>
            <div class="flex-1 flex justify-between sm:justify-end">
                <a href="{{ $prevPage }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="{{ $nextPage }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
        </nav>

    </div>
</x-agnostic-layout>
