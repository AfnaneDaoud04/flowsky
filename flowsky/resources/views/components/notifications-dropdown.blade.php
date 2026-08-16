<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="relative p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800">
        <!-- Icône cloche -->
        <svg class="w-6 h-6 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @auth
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        @endauth
    </button>

    <div x-show="open" @click.outside="open = false" x-cloak
         class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-lg shadow-lg z-50">

        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-200 dark:border-slate-700">
            <span class="font-semibold text-slate-900 dark:text-white">Notifications</span>
            <form method="POST" action="{{ route('notifications.markAllRead') }}">
                @csrf
                <button type="submit" class="text-brand text-sm hover:underline">Mark all read</button>
            </form>
        </div>

        <div class="max-h-96 overflow-y-auto">
            @forelse(auth()->user()->notifications()->latest()->take(10)->get() as $notification)
                <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700 flex items-start gap-3
                    {{ is_null($notification->read_at) ? 'bg-brand-light/50 dark:bg-teal-900/20' : '' }}">

                    <span class="text-xl text-brand-dark">
                        @if(str_contains($notification->type, 'TaskAssigned')) <i class="ti ti-hand"></i>
                        @elseif(str_contains($notification->type, 'NewNoteAdded')) <i class="ti ti-message-circle"></i>
                        @elseif(str_contains($notification->type, 'AddedToProject')) <i class="ti ti-clipboard-list"></i>
                        @endif
                    </span>

                    <div class="flex-1">
                        <p class="text-sm text-slate-700 dark:text-slate-200">{{ $notification->data['message'] }}</p>
                        <p class="text-xs text-slate-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>

                    @if(is_null($notification->read_at))
                        <span class="w-2 h-2 rounded-full bg-brand mt-1"></span>
                    @endif
                </div>
            @empty
                <p class="text-sm text-slate-400 px-4 py-6 text-center">Aucune notification</p>
            @endforelse
        </div>
    </div>
</div>