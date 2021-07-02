<div>
    <ul class="divide-y divide-gray-200">
        @foreach($notifications as $notification)
        <li class="py-4" x-data="{deleted: false, read: {{$notification->read_at != null?'true':'false'}}}" x-show="!deleted">
            <div class="flex space-x-3">
                <div class="flex-1 space-y-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm {{!$notification->read_at?'font-bold':'font-medium'}}"
                            :class="{'font-bold': !read, 'font-medium': read}"
                        >
                            <a href="">{{$notification->title}}</a>
                        </h3>
                        <div class="flex flex-row gap-3 my-auto">
                            <p class="text-sm text-gray-500">{{\Illuminate\Support\Carbon::parse($notification->created_at)->diffForHumans()}}</p>
                            <a href="#" @click.prevent="read = true, $wire.call('read', {{$notification->id}})" class="w-5 h-5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                                </svg>
                            </a>
                            <a href="#" @click.prevent="deleted = true, $wire.call('delete', {{$notification->id}})" class="w-5 h-5 text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500">
                        <a href="">
                            {{$notification->description}}
                        </a>
                    </p>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
</div>
