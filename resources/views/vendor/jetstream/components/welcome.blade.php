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

<div class="bg-gray-200 bg-opacity-25">
    <div class="p-6 overflow-x-auto">
        <table class="m-auto md:w-full border-2">
            <thead>
                <th class="border-b-2 text-left px-2">Column 1</th>
                <th class="border-b-2 text-left px-2">Column 2</th>
                <th class="border-b-2 text-left px-2">Column 3</th>
                <th class="border-b-2 text-left px-2">Column 4</th>
                <th class="border-b-2 text-left px-2 col-span-3">Column 5</th>
            </thead>
            <tbody>
                <tr>
                    <td class="border-b-2 text-left px-2">ligne 1</td>
                    <td class="border-b-2 text-left px-2">ligne 1</td>
                    <td class="border-b-2 text-left px-2">ligne 1</td>
                    <td class="border-b-2 text-left px-2">ligne 1</td>
                    <td class="border-b-2 text-left px-2">ligne 1</td>
                    <td class="border-y-2 text-center px-2">
                        <a class="text-blue-400 rounded cursor-pointer">
                            Edit
                        </a>
                    </td>
                    <td class="border-y-2  text-center px-2">
                        <a class="text-blue-400 rounded cursor-pointer">
                            Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="border-b-2 text-left px-2">ligne 2</td>
                    <td class="border-b-2 text-left px-2">ligne 2</td>
                    <td class="border-b-2 text-left px-2">ligne 2</td>
                    <td class="border-b-2 text-left px-2">ligne 2</td>
                    <td class="border-b-2 text-left px-2">ligne 2</td>
                    <td class="border-y-2  text-center px-2">
                        <a class="text-blue-400 rounded cursor-pointer">
                            Edit
                        </a>
                    </td>
                    <td class="border-y-2  text-center px-2">
                        <a class="text-blue-400 rounded cursor-pointer">
                            Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="border-b-2 text-left px-2">ligne 3</td>
                    <td class="border-b-2 text-left px-2">ligne 3</td>
                    <td class="border-b-2 text-left px-2">ligne 3</td>
                    <td class="border-b-2 text-left px-2">ligne 3</td>
                    <td class="border-b-2 text-left px-2">ligne 3</td>
                    <td class="border-y-2  text-center px-2">
                        <a class="text-blue-400 rounded cursor-pointer">
                            Edit
                        </a>
                    </td>
                    <td class="border-y-2  text-center px-2">
                        <a class="text-blue-400 rounded cursor-pointer">
                            Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
