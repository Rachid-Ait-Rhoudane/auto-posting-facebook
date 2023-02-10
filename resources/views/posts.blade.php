<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts page') }}
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
                            Here you can see your previous published/scheduled posts.
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('add.post') }}" class="bg-blue-400 rounded px-4 py-2 hover:bg-blue-300">Add post</a>
                        </div>
                    </div>
                </div>

                @if(session()->has('success_scheduled'))
                    <script>
                        swal("Your post scheduled successfully", {
                        icon: "success",
                        });
                    </script>
                @endif

                @if(session()->has('success_published'))
                    <script>
                        swal("Your post published successfully", {
                        icon: "success",
                        });
                    </script>
                @endif

                @if(session()->has('success'))
                    <script>
                        swal("Your post updated successfully", {
                        icon: "success",
                        });
                    </script>
                @endif
                @livewire('posts-table')

            </div>
        </div>
    </div>
</x-app-layout>
