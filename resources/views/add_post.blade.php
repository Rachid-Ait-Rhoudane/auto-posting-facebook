<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new post page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Welcome to your Auto Posting Facebook application!
                    </div>
                    <div class="md:flex md:justify-between">
                        <div class="mt-6 text-gray-500">
                        Here, you can add or schedule new posts on your Facebook pages.
                        </div>
                    </div>

                    @livewire('add-post')

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
