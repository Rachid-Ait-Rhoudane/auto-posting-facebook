<div class="bg-gray-200 bg-opacity-25">
    <div class="p-6 overflow-x-auto">
        <table class="m-auto md:w-full border-2">
            <thead>
                <th class="border-b-2 text-left px-2">Post</th>
                <th class="border-b-2 text-left px-2">Type</th>
                <th class="border-b-2 text-left px-2 col-span-3">Date</th>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td class="border-b-2 text-left px-2">{{ $post->post }}</td>
                        <td class="border-b-2 text-left px-2">{{ $post->type }}</td>
                        <td class="border-b-2 text-left px-2">{{ $post->date }}</td>
                        <td class="border-y-2  text-center px-2">
                            <a href="{{ route('edit.post', $post->id) }}" class="text-blue-400 hover:text-blue-300 rounded cursor-pointer">
                                Edit
                            </a>
                        </td>
                        <td class="border-y-2  text-center px-2">

                            @livewire('delete-post', ["post" => $post], key($post->id))

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

