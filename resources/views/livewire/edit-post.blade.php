<div class="py-5">
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form wire:submit.prevent="update">
        <div class="overflow-hidden shadow sm:rounded-md">
          <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">

                <div class="col-span-6 sm:col-span-3">
                    <label for="page" class="block text-sm font-medium text-gray-700"><strong>Page: </strong>{{ $page_name }}</label>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="page" class="block text-sm font-medium text-gray-700 mb-10"><strong>Current post: </strong></label>
                    <label for="page" class="block text-sm font-medium text-gray-700">{{ $post->post }}</label>
                    @if($post->type ==  'Image')
                        <img width="300" height="300" src="{{ asset('storage/photos/'.$post->file_path) }}" alt="post image">
                    @elseif($post->type ==  'Video')
                        <video width="400" controls>
                            <source src="{{ asset('storage/videos/'.$post->file_path) }}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    @endif
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="text" class="block text-sm font-medium text-gray-700"><strong>Text</strong></label>
                    <div class="mt-1">
                        <textarea id="text" wire:model="text" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Please write your text here.">
                        </textarea>
                    </div>
                </div>

                @if($post->type != 'Text')
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block text-sm font-medium text-gray-700"><strong>Image/Video</strong></label>
                        <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                            <div class="space-y-1 text-center">

                                <div class="flex">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                        <g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M28.186 9.069l-6.855 4.122v-4.655c0-0.883-0.716-1.599-1.599-1.599h-17.060c-0.884 0-1.599 0.716-1.599 1.599v14.928c0 0.883 0.715 1.599 1.599 1.599h17.060c0.883 0 1.599-0.716 1.599-1.599v-4.744l7.006 4.211h2.591v-13.861h-2.742zM20.265 23.464c0 0.294-0.24 0.533-0.533 0.533h-17.060c-0.295 0-0.533-0.239-0.533-0.533v-14.928c0-0.294 0.238-0.533 0.533-0.533h17.060c0.294 0 0.533 0.239 0.533 0.533v14.928zM29.861 21.864h-1.229l-7.301-4.389v-3.039l7.15-4.3h1.38v11.729z" fill="#808080"> </path> </g>
                                    </svg>
                                </div>

                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" wire:model="file"  type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, MP4 up to 10MB</p>
                            </div>
                        </div>
                        @error('file')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>
        </div>
      </form>
    </div>
</div>
