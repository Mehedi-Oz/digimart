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
            margin: 0;
            padding: 20px;
            border: 2px dashed #6c757d;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        #fileUpload {
            margin: 1em 0;
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
            min-height: auto;
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
                            <option @selected($selectedCategory->slug == $category->slug) value="{{ $category->slug }}">{{ $category->name }}
                            </option>
                        @endforeach
                    </x-frontend.input-select>
                </div>
                <div class="col-md-12">
                    <x-frontend.input-select name="sub_category" :label="__('Sub Category')" class="select_2" :required="true">
                        @foreach ($selectedCategory->subcategories as $sub_category)
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
                        @foreach ($uploadedFiles as $uploadedFile)
                            <li class="list-group-item file-list-item d-flex align-items-center justify-content-between"
                                id="file-{{ $uploadedFile->id }}">
                                <div class="w-100">
                                    <div class="d-flex align-items-center">
                                        <i class="{{ getIcon($uploadedFile->mime_type) }} fs-3 me-3 text-primary"></i>
                                        <span>{{ $uploadedFile->name }} <span
                                                class="file-size">({{ formatSize($uploadedFile->size) }})</span></span>
                                    </div>
                                    <div class="progress me-3" style="width:100%; height: 5px;">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: 100%;" id=""></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
                                    onclick="removeFile('{{ $uploadedFile->id }}')"><i class="bi bi-trash3"></i>
                                </button>
                            </li>
                        @endforeach
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
                    <x-frontend.input-select id="preview_file_input" name="preview_file" :label="__('Preview File')" class="select_2"
                        :required="true">
                        @foreach ($uploadedFiles as $uploadedFile)
                            <option value="{{ $uploadedFile->path }}">{{ $uploadedFile->name }}</option>
                        @endforeach
                    </x-frontend.input-select>
                </div>
                <div class="col-md-12">
                    <label class="form-label mb-2 font-18 font-heading fw-600">{{ __('Main File') }}
                        <code>*</code>
                    </label>
                    <div class="input-group mb-3">
                        <select class="form-select" id="main_file_selector">
                            <option selected value="upload">{{ __('Upload') }}</option>
                            <option value="link">{{ __('Link') }}</option>
                        </select>
                        <select class="form-select" id="upload_source">
                            @foreach ($uploadedFiles as $uploadedFile)
                                <option value="{{ $uploadedFile->path }}">{{ $uploadedFile->name }}</option>
                            @endforeach
                        </select>
                        <input id="link_source" type="text" name="main_file"
                            class="form-control {{ $errors->has('main_file') ? 'is-invalid' : '' }} d-none"
                            aria-label="Text input with dropdown button">
                    </div>
                    <x-input-error :messages="$errors->first('main_file')" />
                </div>
                <div class="col-md-12">
                    <x-frontend.input-select id="screenshot_input" name="screenshots[]" :label="__('Screenshots')"
                        multiple="multiple" class="select_2" :required="true">
                        @foreach ($uploadedFiles as $uploadedFile)
                            <option value="{{ $uploadedFile->path }}">{{ $uploadedFile->name }}</option>
                        @endforeach
                    </x-frontend.input-select>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        let notyf = new Notyf({
            duration: 3000
        });

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

                    //set uploaded files
                    let uploadedFilesWrapper = document.getElementById('fileList');
                    uploadedFilesWrapper.innerHTML = response.html;
                    setDynamicOptions(response);

                });
                this.on("error", function(file, errorMessage) {
                    let errors = errorMessage.errors;
                    for (const key in errors) {
                        errors[key].forEach(error => {
                            notyf.error(error);
                        });
                    }

                    const listItem = document.getElementById(`file-${file.upload.uuid}`);
                    if (listItem) {
                        const progressBar = listItem.querySelector(".progress-bar");
                        progressBar.classList.remove("progress-bar-animated");
                        progressBar.classList.add("bg-danger");
                        progressBar.style.width = "100%";
                    }
                });
            }
        });

        function setDynamicOptions(response) {
            let preview_file_input = document.getElementById('preview_file_input');
            let screenshot_input = document.getElementById('screenshot_input');
            let uploadSource = document.getElementById('upload_source');

            preview_file_input.innerHTML = '';
            screenshot_input.innerHTML = '';
            uploadSource.innerHTML = '';

            for (let i = 0; i < response.files.length; i++) {
                let file = response.files[i];
                let option = document.createElement("option");
                option.value = file.path;
                option.text = file.name;
                preview_file_input.appendChild(option);

                let screenshotOption = document.createElement("option");
                screenshotOption.value = file.path;
                screenshotOption.text = file.name;
                screenshot_input.appendChild(screenshotOption);

                let uploadOption = document.createElement("option");
                uploadOption.value = file.path;
                uploadOption.text = file.name;
                uploadSource.appendChild(uploadOption);
            }
        }

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
            listItem.innerHTML = `<div class="w-100">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi ${fileIcon} fs-3 me-3 text-primary"></i>
                                                                <span>${file.name} <span class="file-size">${getFileSize(file)}</span></span>
                                                    </div>
                                                <div class="progress me-3" style="width:100%; height: 5px;">
                                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                                    style="width: 0%;" id="progress-${file.upload.uuid}"></div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
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

            $.ajax({
                method: 'DELETE',
                url: '/user/items/destroy/:id'.replace(':id', uuid),
                data: {
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.message) {
                        notyf.success(response.message);
                        setDynamicOptions(response);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        notyf.error(xhr.responseJSON.message);
                    }
                }
            });
        }

        document.getElementById("main_file_selector").addEventListener("change", function() {
            const selectedValue = this.value;
            const uploadSource = document.getElementById("upload_source");
            const linkSource = document.getElementById("link_source");

            if (selectedValue === "upload") {
                uploadSource.classList.remove("d-none");
                linkSource.classList.add("d-none");
            } else if (selectedValue === "link") {
                uploadSource.classList.add("d-none");
                linkSource.classList.remove("d-none");
            }
        });
    </script>
@endpush
