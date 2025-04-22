<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <div class="flex min-h-screen">
            {{-- Sidebar --}}
            <flux:sidebar sticky stashable class="min-h-screen border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

                <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                    <x-app-logo />
                </a>

                <flux:navlist variant="outline">
                    <flux:navlist.group>
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:navlist variant="outline" icon="folder" x-data="{ open: false }">
                    <flux:navlist.group>
                        <button @click="open = ! open" class="flex items-center w-full text-left">
                            <flux:navlist.item icon="folder" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Data Manager') }}</flux:navlist.item>
                            <x-icon name="chevron-down" class="ml-auto shrink-0" x-bind:class="{ 'rotate-180': open }" />
                        </flux:navlist.group>
                    </button>
                    <div x-show="open" class="mt-1 ml-4 space-y-1">
                        <flux:navlist.item :href="route('absensi.index')" :current="request()->routeIs('absensi.*')" wire:navigate class="pl-2">{{ __('Absensi') }}</flux:navlist.item>
                        <flux:navlist.item :href="route('jadwal.index')" :current="request()->routeIs('jadwal.*')" wire:navigate class="pl-2">{{ __('Jadwal') }}</flux:navlist.item>
                    </div>
                </flux:navlist>

                <flux:navlist variant="outline" icon="folder" x-data="{ open: false }">
                    <flux:navlist.group>
                        <button @click="open = ! open" class="flex items-center w-full text-left">
                            <flux:navlist.item icon="folder" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Data Karyawan') }}</flux:navlist.item>
                            <x-icon name="chevron-down" class="ml-auto shrink-0" x-bind:class="{ 'rotate-180': open }" />
                        </flux:navlist.group>
                    </button>
                    <div x-show="open" class="mt-1 ml-4 space-y-1">
                        <flux:navlist.item :href="route('absensi.index')" :current="request()->routeIs('absensi.*')" wire:navigate class="pl-2">{{ __('Absensi') }}</flux:navlist.item>
                        <flux:navlist.item :href="route('jadwal.index')" :current="request()->routeIs('jadwal.*')" wire:navigate class="pl-2">{{ __('Jadwal') }}</flux:navlist.item>
                    </div>
                </flux:navlist>

                <flux:navlist variant="outline">
                    <flux:navlist.group>
                        <flux:navlist.item icon="clipboard" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Prediksi') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:spacer />

                <!-- Desktop User Menu -->
                <flux:dropdown position="bottom" align="start">
                    <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()" icon-trailing="chevrons-up-down" />

                    <flux:menu class="w-[220px]">
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-left text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </flux:sidebar>

            {{-- Konten Utama --}}
            <main class="flex-1 overflow-x-hidden">
                <!-- Mobile User Menu (bisa tetap di sini atau di atas slot) -->
                <flux:header class="lg:hidden">
                    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                    <flux:spacer />
                    {{-- ...mobile menu content --}}
                </flux:header>

                {{-- Slot konten (tabel, dll) --}}
                {{ $slot }}
            </main>
        </div>

        @fluxScripts
    </body>
</html>
