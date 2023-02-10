<div class="bg-gray-200 bg-opacity-25">
    <div class="p-6 overflow-x-auto">
        <table class="m-auto md:w-full border-2">
            <thead>
                <th class="border-b-2 text-left px-2">Page name</th>
                <th class="border-b-2 text-left px-2 col-span-2">Add on</th>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td class="border-b-2 text-left px-2">{{ $page->facebook_page_name }}</td>
                        <td class="border-b-2 text-left px-2">{{ $page->created_at }}</td>
                        <td class="border-y-2  text-center px-2">

                            @livewire('delete-page', ['page' => $page], key($page->id))

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
