@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Items') }}
@endsection

@push('styles')
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">

    <style>
        .dz-message {
            padding: 20px;
            border: 2px dashed #6c757d;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .dz-message:hover {
            background-color: #e9ecef;
        }

        .dz-message .bi-plus-circle {
            animation: bounce 2s infinite ease-in-out;
        }

        .dz-message .add-file-icon {
            font-size: 2rem;
            font-weight: bolder;
        }

        .dz-message .add-file-text {
            font-size: 1.5rem;
        }

        .file-text-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-list-item {
            background-color: #f8f9fa;
        }

        .dropzone {
            min-height: 150px;
            border: none;
            background: none;
            padding: 0;
        }

        .btn-outline-secondary {
            color: #ffffff !important;
            background-color: #6c757d !important;
        }

        .btn-outline-secondary:hover,
        .btn-outline-secondary:focus {
            color: #fff !important;
            background-color: #0088ff !important;
        }

        .input-group .form-control:focus {
            box-shadow: none !important;
            border-color: #ced4da !important;
        }
    </style>
@endpush

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-item-center justify-content-between">
            <div>
                <h5>{{ __('New Item') }}</h5>
                <p>{{ __('Create a new Item') }}</p>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('Back') }}
                </button>
            </div>
        </div>
    </div>
    <form action="" method="POST">
        @csrf
        <div class="wsus__dash_order_table mt-3">
            <div>
                <h6>{{ __('Name & Description') }}</h6>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <x-frontend.input-text name="name" :label="__('Name')" placeholder="{{ __('enter your name') }}"
                        :required="true" />
                    <x-frontend.text-area id="editor" name="description" :label="__('Description')"
                        placeholder="{{ __('description') }}" :required="true" />
                </div>
            </div>
        </div>
        <div class="wsus__dash_order_table mt-3">
            <div>
                <h6>{{ __('Category & Attributes') }}</h6>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <x-frontend.input-select name="category" :label="__('Category')" class="select_2" :required="true" disabled>
                        @foreach ($categories as $category)
                            <option @selected($selected_category->slug == $category->slug) value="{{ $category->slug }}">{{ $category->name }}
                            </option>
                        @endforeach
                    </x-frontend.input-select>
                </div>
                <div class="col-md-12">
                    <x-frontend.input-select name="sub_category" :label="__('Sub Category')" class="select_2" :required="true">
                        @foreach ($selected_category->subcategories as $sub_category)
                            <option value="{{ $sub_category->slug }}">{{ $sub_category->name }}</option>
                        @endforeach
                    </x-frontend.input-select>
                </div>
                <div class="col-md-12">
                    <x-frontend.input-text name="version" :label="__('Version')" placeholder="{{ __('enter product version') }}"
                        :required="true" />
                </div>
                <div class="col-md-12">
                    <x-frontend.input-text name="demo_link" :label="__('Demo Link (optional)')" placeholder="{{ __('enter demo link') }}" />
                </div>
                <div class="col-md-12">
                    <x-frontend.input-text name="tags" :label="__('Tags')" data-role="tagsinput" :required="true"
                        :hint="__('The allowed files to be uploaded as main file: zip, mp4, mp3, png, etc.')" />
                </div>
            </div>
        </div>
        <div class="wsus__dash_order_table mt-3">
            <div>
                <h6>{{ __('Files') }}</h6>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="dropzone" id="fileUpload">
                        <div class="dz-message text-center">
                            <div class="mb-2 file-text-wrapper">
                                <i class="bi bi-plus add-file-icon"></i>
                                <span class="add-file-text">File Upload</span>
                            </div>
                            <p class="text-muted mt-2">Drop files here or click to upload</p>
                        </div>
                    </div>

                    <ul class="list-group" id="fileList">
                        <!-- Uploaded files will appear here -->
                    </ul>
                </div>
                <div class="col-md-12">
                    <x-frontend.input-select name="preview_type" :label="__('Preview Type')" class="select_2" :required="true">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                    </x-frontend.input-select>
                </div>
                <div class="col-md-12">
                    <x-frontend.input-select name="preview_file" :label="__('Preview File')" class="select_2" :required="true">
                    </x-frontend.input-select>
                </div>
                <div class="col-md-12">
                    <div class="form_box">
                        <label class="form-label mb-2 font-18 font-heading fw-600">{{ __('Main File') }}
                            <code>*</code>
                        </label>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">{{ __('Upload') }}</a></li>
                                <li><a class="dropdown-item" href="#">{{ __('Link') }}</a></li>
                            </ul>
                            <input type="text" name="main_file"
                                class="form-control {{ $errors->has('main_file') ? 'is-invalid' : '' }}"
                                aria-label="Text input with dropdown button">
                        </div>
                        <x-input-error :messages="$errors->first('main_file')" />
                    </div>
                </div>
                <div class="col-md-12">
                    <x-frontend.input-select name="screenshots[]" :label="__('Screenshots')" multiple="multiple" class="select_2"
                        :required="true">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                    </x-frontend.input-select>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('scripts')
    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    {{-- <script src="{{ asset('assets/frontend/js/drop-zone.js') }}"></script> --}}
    <script>
        const csrfToken = "{{ csrf_token() }}";
        // Initialize Dropzone
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("#fileUpload", {
            url: "{{ route('user.items.uploads') }}", // Server endpoint
            maxFilesize: 100, // Max file size in MB
            parallelUploads: 5, // Number of files to upload in parallel
            uploadMultiple: true,
            addRemoveLinks: false, // Disable default Dropzone remove links
            previewsContainer: false, // Hide default Dropzone previews
            clickable: "#fileUpload", // Makes the #fileUpload div clickable
            headers: {
                "X-CSRF-TOKEN": csrfToken // Pass CSRF token in headers
            },
            init: function() {
                this.on("addedfile", function(file) {
                    // create list item
                    createListItem(file);
                });
                this.on("uploadprogress", function(file, progress) {
                    // Update progress bar
                    const progressBar = document.getElementById(`progress-${file.upload.uuid}`);
                    if (progressBar) {
                        progressBar.style.width = `${progress}%`;
                    }
                });
                this.on("success", function(file, response) {
                    const listItem = document.getElementById(`file-${file.upload.uuid}`);
                    if (listItem) {
                        const progressBar = listItem.querySelector(".progress-bar");
                        progressBar.classList.remove("progress-bar-animated");
                        progressBar.classList.add("bg-success");
                        progressBar.style.width = "100%";
                    }
                });
                this.on("error", function(file, errorMessage) {
                    const listItem = document.getElementById(`file-${file.upload.uuid}`);
                    if (listItem) {
                        const progressBar = listItem.querySelector(".progress-bar");
                        progressBar.classList.remove("progress-bar-animated");
                        progressBar.classList.add("bg-danger");
                        progressBar.style.width = "100%";
                    }
                });
            },
        });
        // Function to get file icon
        function getIcon(fileType) {
            let fileIcon = "bi-file-earmark"; // Default icon
            if (fileType.startsWith("image/")) fileIcon = "bi-file-earmark-image";
            else if (fileType.startsWith("video/")) fileIcon = "bi-file-earmark-play";
            else if (fileType.startsWith("audio/")) fileIcon = "bi-file-earmark-music";
            else if (fileType.endsWith("pdf")) fileIcon = "bi-file-earmark-pdf";
            else if (fileType.startsWith("text/")) fileIcon = "bi-file-earmark-text";
            else if (fileType.startsWith("application/")) fileIcon = "bi-file-earmark-zip";
            return fileIcon;
        }
        // create list item
        function createListItem(file) {
            // Determine file type icon
            const fileIcon = getIcon(file.type);
            // Create list item
            const listItem = document.createElement("li");
            listItem.className =
                "list-group-item file-list-item d-flex align-items-center justify-content-between";
            listItem.id = `file-${file.upload.uuid}`;
            listItem.innerHTML = `
            <div class="w-100">
                <div class="d-flex align-items-center">
                    <i class="bi ${fileIcon} fs-3 me-3 text-primary"></i>
                    <span>${file.name} <span class="file-size">${getFileSize(file)}</span></span>
                </div>
                <div class="progress me-3" style="width:100%; height: 5px;">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                        style="width: 0%;" id="progress-${file.upload.uuid}"></div>
                </div>
            </div>
            <button class="btn btn-danger btn-sm justify-content-end ms-3"
                onclick="removeFile('${file.upload.uuid}')"><i class="bi bi-trash3"></i>
            </button>
            `;
            document.getElementById("fileList").appendChild(listItem);
        }
        // get file size
        function getFileSize(file) {
            const size = file.size;
            const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
            return `(${(size / Math.pow(1024, i)).toFixed(2) * 1} ${["B", "KB", "MB", "GB", "TB"][i]})`;
        }
        // Function to remove file
        function removeFile(uuid) {
            const listItem = document.getElementById(`file-${uuid}`);
            if (listItem) {
                listItem.remove();
            }
        }
    </script>
@endpush
