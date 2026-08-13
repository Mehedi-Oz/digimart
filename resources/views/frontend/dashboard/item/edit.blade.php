@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Update Item') }}
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
                <h5>{{ __('Update Item') }}</h5>
                <p>{{ __('Manage an Item') }}</p>
            </div>
            <div>
                <!-- Button trigger modal -->
                <a href="{{ route('user.items.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" id="item-form">
        @csrf
        @method('PUT')

        <ul class="nav nav-pills mt-3">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                    href="{{ route('user.items.edit', $item->id) }}">{{ __('Edit Details') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.items.changelog', $item->id) }}">{{ __('Change Logs') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.items.history', $item->id) }}">{{ __('History') }}</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-7">
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6>{{ __('Name & Description') }}</h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <x-frontend.input-text name="name" :label="__('Name')"
                                placeholder="{{ __('enter your name') }}" :required="true" :value="$item->name" />
                            <x-frontend.text-area id="editor" name="description" :label="__('Description')"
                                placeholder="{{ __('description') }}" :required="true" :value="$item->description" />
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
                            <x-frontend.input-text name="category" value="{{ $item->category->name }}" :label="__('Category')"
                                disabled />
                        </div>
                        <div class="col-md-12">
                            <x-frontend.input-text name="sub_category" value="{{ $item->subcategory->name }}"
                                :label="__('SubCategory')" disabled />
                        </div>
                        <div class="col-md-12">
                            <x-frontend.input-text name="version" :label="__('Version')" value="{{ $item->version }}" />
                        </div>
                        <div class="col-md-12">
                            <x-frontend.input-text name="demo_link" :label="__('Demo Link (optional)')" value="{{ $item->demo_link }}" />
                        </div>
                        <div class="col-md-12">
                            <x-frontend.input-text name="tags" :label="__('Tags')" data-role="tagsinput"
                                :required="true" :hint="__(
                                    'The allowed files to be uploaded as main file: zip, mp4, mp3, png, etc.',
                                )" value="{{ implode(',', $item->tags) }}" />
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
                                                <i
                                                    class="{{ getIcon($uploadedFile->mime_type) }} fs-3 me-3 text-primary"></i>
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
                            <x-frontend.input-select name="preview_type" :label="__('Preview Type')" class="select_2">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                                <option value="audio">Audio</option>
                            </x-frontend.input-select>
                        </div>
                        <div class="col-md-12">
                            <x-frontend.input-select id="preview_file_input" name="preview_file" :label="__('Preview File')"
                                class="select_2">
                                @foreach ($uploadedFiles as $uploadedFile)
                                    <option value="{{ $uploadedFile->path }}">{{ $uploadedFile->name }}</option>
                                @endforeach
                            </x-frontend.input-select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label mb-2 font-18 font-heading fw-600">{{ __('Main File') }}
                                <code></code>
                            </label>
                            <div class="input-group mb-3">
                                <select name="source_type" class="form-select" id="main_file_selector">
                                    <option selected value="">{{ __('Select') }}</option>
                                    <option value="upload">{{ __('Upload') }}</option>
                                    <option value="link">{{ __('Link') }}</option>
                                </select>
                                <select name="upload_source" class="form-select" id="upload_source">
                                    @foreach ($uploadedFiles as $uploadedFile)
                                        <option value="{{ $uploadedFile->path }}">{{ $uploadedFile->name }}</option>
                                    @endforeach
                                </select>
                                <input id="link_source" name="link_source" type="text" class="form-control d-none"
                                    aria-label="Text input with dropdown button">
                            </div>
                            <x-input-error :messages="$errors->first('main_file')" />
                        </div>
                        <div class="col-md-12">
                            <x-frontend.input-select id="screenshot_input" name="screenshots[]" :label="__('Screenshots')"
                                multiple="multiple" class="select_2">
                                @foreach ($uploadedFiles as $uploadedFile)
                                    <option value="{{ $uploadedFile->path }}">{{ $uploadedFile->name }}</option>
                                @endforeach
                            </x-frontend.input-select>
                        </div>
                    </div>
                </div>
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6>{{ __('Support') }}</h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <x-frontend.input-select id="support-input" name="support" :label="__('Item will be supported?')"
                                :required="true">
                                <option @selected($item->supported == 1) value="1">{{ __('Yes') }}</option>
                                <option @selected($item->supported == 0) value="0">{{ __('No') }}</option>
                            </x-frontend.input-select>
                        </div>
                        <div class="col-md-12 d-none" id="support-instruction">
                            <x-frontend.text-area name="support_instruction" :label="__('Support Instructions')" />
                        </div>
                    </div>
                </div>
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6>{{ __('Pricing') }}</h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <x-frontend.input-text name="price" :label="__('Regular Price')" :required="true"
                                value="{{ $item->price }}" />
                        </div>
                        <div class="col-md-6">
                            <x-frontend.input-text name="discount_price" :label="__('Discount Price')"
                                value="{{ $item->discount_price }}" />
                        </div>
                    </div>
                </div>
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6>{{ __('Free Item') }}</h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <x-frontend.input-select name="is_free" :label="__('Is the item free?')" :hint="__('Allow downloading for free? Anyone can download without purchasing!')"
                                :required="true">
                                <option @selected($item->is_free == 0) value="0">{{ __('No') }}</option>
                                <option @selected($item->is_free == 1) value="1">{{ __('Yes') }}</option>
                            </x-frontend.input-select>
                        </div>
                    </div>
                </div>
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6>{{ __('Message to the Reviewer') }}</h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <x-frontend.text-area name="message_for_reviewer" :label="__('Message')" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6></h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6"><b>{{ __('ID') }}</b></div>
                        <div class="col-md-6 text-end">{{ $item->id }}</div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Name') }}</b></div>
                        <div class="col-md-6 text-end">{{ $item->name }}</div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Category') }}</b></div>
                        <div class="col-md-6 text-end">{{ $item->category->name }} / {{ $item->subcategory->name }}</div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Status') }}</b></div>
                        <div class="col-md-6 text-end">
                            @if ($item->status == 'approved')
                                <span class="badge bg-success">{{ __('Approved') }}</span>
                            @elseif ($item->status == 'pending')
                                <span class="badge bg-warning">{{ __('Pending') }}</span>
                            @elseif ($item->status == 'soft_reject')
                                <span class="badge bg-secondary">{{ __('Soft Reject') }}</span>
                            @elseif ($item->status == 'hard_reject')
                                <span class="badge bg-danger">{{ __('Hard Reject') }}</span>
                            @elseif ($item->status == 'resubmitted')
                                <span class="badge bg-primary">{{ __('Resubmitted') }}</span>
                            @endif
                        </div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Publish Date') }}</b></div>
                        <div class="col-md-6 text-end">{{ formatDate($item->created_at) }}</div>
                        <div class="col-md-12 mt-2">
                            @if ($item->demo_link)
                                <a class="btn btn-yellow w-100 mb-2"
                                    href="{{ $item->demo_link }}">{{ __('Demo') }}</a>
                            @endif

                            @if ($item->is_main_file_external == 1)
                                <a class="btn btn-primary w-100" href="{{ $item->main_file }}">{{ __('File Link') }}</a>
                            @else
                                <a class="btn btn-primary w-100"
                                    href="{{ route('user.items.download', $item->id) }}">{{ __('Download') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__dash_order_table mt-3">
            <div class="row">
                <div class="col-md-12">
                    <x-frontend.submit-button :label="__('Update Item')" />
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

        /* hide upload section based on main_file_selector */
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

        /* hide support instruction based on support input */
        document.getElementById("support-input").addEventListener("change", function() {
            const selectedValue = this.value;
            const supportInstruction = document.getElementById('support-instruction');

            if (selectedValue === "1") {
                supportInstruction.classList.remove('d-none');
            } else if (selectedValue === "0") {
                supportInstruction.classList.add('d-none');
            }
        });

        /* handle form submission */
        $('#item-form').on('submit', function(e) {
            e.preventDefault();

            if (window.tinymce) {
                tinymce.triggerSave();
            }

            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: "{{ route('user.items.update', $item->id) }}",
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr, status, error) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        errors[key].forEach(error => {
                            notyf.error(error);
                        });
                    }
                }
            })
        });
    </script>
@endpush
