<div x-data="fileUpload()"
     wire:init="init"
>
    <div class="flex flex-col items-center justify-center bg-slate-200 rounded-md relative"
         x-on:drop="isDropping = false"
         x-on:drop.prevent="handleFileDrop($event)"
         x-on:dragover.prevent="isDropping = true"
         x-on:dragleave.prevent="isDropping = false"
    >

        <div
            class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-blue-500 opacity-90 rounded-md"
            x-show="isDropping"
            wire:key="{{ "dropping-$imageType" }}"
        >
            <span class="text-3xl text-white">
                {{ __('Release file to upload!') }}
            </span>
        </div>

        @if(!$files->count())
            <label
                class="flex flex-col items-center justify-center w-1/2  bg-white border shadow cursor-pointer rounded-2xl hover:bg-slate-50 mt-2 px-2 py-1"
                for="file-upload-{{ $imageType }}"
            >
                <h3 class="text-2xl text-center">{{ __('Click here to select files to upload') }}</h3>
                <em class="italic text-slate-400">{{ __('(Or drag files to the page)') }}</em>
            </label>
        @endif

        @if($isLoading)
            <div class="p-4">
                <x-loading-icon class="h-16 w-16"/>
            </div>
        @endif

        @if($files->count())
            <div class="flex flex-wrap p-4">

                <div class="relative p-2">
                    <label
                        class="flex flex-col items-center justify-center h-full bg-white border shadow cursor-pointer rounded-md hover:bg-slate-50 px-2 py-1"
                        for="file-upload-{{ $imageType }}"
                    >
                        <h3 class="text-sm/[16px] text-center">{{ __('Click here to select files to upload') }}</h3>
                        <em class="italic text-sm/[12px] text-slate-400">{{ __('(Or drag files to the page)') }}</em>
                    </label>
                </div>


                @foreach($files as $file)
                    <div class="relative p-2"
                         wire:key="{{ 'file-' . $file->id }}"
                    >
                        <img src="{{ $file?->url }}" class="w-24 h-24 object-cover rounded-md bg-gray-500"
                             alt="image preview"
                        >
                        <div>
                            @if($file->type === \App\Enums\ImageType::COVER->value)
                                <p class="absolute bottom-2 left-2 right-2 py-0.5 px-1 font-semibold bg-indigo-400 text-white rounded-md text-sm/[14px]">
                                    {{ __('Cover') }}
                                </p>
                            @endif
                        </div>

                        <div class="absolute top-0 right-0">

                            <button id="dropdownButtonFileDetails"
                                    class="text-red-500 w-6 h-6 bg-white hover:bg-gray-200 rounded-full"
                                    type="button"
                                    @click="openFileDetails('{{ $file->id }}')"
                            >
                                <box-icon class="fill-black w-6 h-6"
                                          name='dots-horizontal-rounded'
                                >
                                </box-icon>
                            </button>


                            <button class="text-red-500 w-6 h-6 bg-white hover:bg-gray-200 rounded-full"
                                    type="button"
                                    @click="removeUpload('{{$file->id}}')"
                            >
                                <box-icon class="fill-black w-6 h-6" name='x-circle'></box-icon>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        <input
            type="file"
            id="file-upload-{{ $imageType }}"
            class="hidden"
            :disabled="isUploading"
            multiple
            wire:key="file-upload-{{ $imageType }}"
            x-on:change="handleFileSelect"
        />


        <div class="w-full bg-red-200 rounded-full dark:bg-red-700">
            @if($limitUpload && $limitUpload <= $files->count())
                {{ __('Limit of :number has been reached', ['number' => $limitUpload]) }}
            @endif
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700"
             {{--             x-show="isUploading"--}}
             x-on:livewire-upload-start="isUploading = true"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress"
        >
            <div class="bg-indigo-600 h-2.5 rounded-full dark:bg-indigo-500"
                 :style="`width: ${progress}%;`"
            >
            </div>
        </div>

    </div>

    <x-dialog-modal wire:model="displayingFileSettings">
        <x-slot name="title">
            {{ __('Image Settings') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <h3 class="text-xl font-semibold">
                    {{ __('Type') }}
                </h3>

                <div class="flex gap-1 my-1">
                    <x-input type="radio"
                             value="default"
                             wire:model="selectedImageType"
                    />
                    <x-label>
                        {{ __('Default') }}
                    </x-label>
                </div>
                <div class="flex gap-1 my-1">
                    <x-input type="radio"
                             value="cover"
                             wire:model="selectedImageType"
                    />
                    <x-label>
                        {{ __('Cover') }}
                    </x-label>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button
                type="button"
                x-on:click="saveImageDetails"
                wire:loading.attr="disabled"
            >
                {{ __('Save') }}
            </x-button>
            <x-secondary-button
                type="button"
                wire:click="$set('displayingFileSettings', false)"
                wire:loading.attr="disabled"
            >
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <script>

        function fileUpload() {
            return {
                isDropping: false,
                isUploading: false,
                progress: 0,
                handleFileSelect(event) {
                    if (event.target.files.length) {
                        this.uploadFiles(event.target.files)
                    }
                },
                handleFileDrop(event) {
                    if (event.dataTransfer.files.length) {
                        this.uploadFiles(event.dataTransfer.files)
                    }
                },
                uploadFiles(files) {
                    const $this = this;
                    this.isUploading = true
                    @this.uploadMultiple('files', files,
                        function (success) {
                            $this.isUploading = false
                            $this.progress = 0

                            {{--$this.$dispatch('notification', {--}}
                            {{--    type: 'success',--}}
                            {{--    text: '{{ __('Successfully uploaded!') }}'--}}
                            {{--})--}}
                        },
                        function (error) {
                            {{--$this.$dispatch('notification', {--}}
                            {{--    type: 'error',--}}
                            {{--    text: '{{ __('Uploading failed!') }}'--}}
                            {{--})--}}
                        },
                        function (event) {
                            $this.progress = event.detail.progress
                        }
                    )
                },
                removeUpload(id) {
                    @this.removeUpload('files', id)
                },
                openFileDetails(id) {
                    this.$wire.set('displayingFileSettings', true)
                    this.$wire.selectImage(id)
                },
                saveImageDetails() {
                    @this.saveImageDetails()
                    this.$wire.set('displayingFileSettings', false)

                }
            }
        }
    </script>
</div>
