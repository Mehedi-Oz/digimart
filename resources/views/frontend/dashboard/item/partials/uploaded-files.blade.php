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
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%;"
                    id=""></div>
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
            onclick="removeFile('{{ $uploadedFile->id }}')"><i class="bi bi-trash3"></i>
        </button>
    </li>
@endforeach
