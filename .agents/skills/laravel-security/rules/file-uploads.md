## File Upload Security

### Validation

```php
public function rules(): array
{
    return [
        'document' => [
            'required',
            'file',
            'mimes:pdf,doc,docx,xls,xlsx', // Whitelist specific MIME types
            'max:10240', // 10MB
            'extensions:pdf,doc,docx,xls,xlsx', // Verify extension matches MIME
        ],
        'avatar' => [
            'nullable',
            'image', // Ensures it's a valid image
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
            'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
        ],
    ];
}
```

### Secure Storage

```php
// Store files outside public directory
$path = $request->file('document')->store('documents', 'local');
// Never use 'public' disk for sensitive documents

// Use signed URLs for temporary file access
use Illuminate\Support\Facades\Storage;

public function download(Request $request, string $path)
{
    // Generate temporary signed URL (expires in 15 minutes)
    $url = Storage::temporaryUrl($path, now()->addMinutes(15));

    // Validate user has permission
    $this->authorize('download', $path);

    return redirect($url);
}

// Storage configuration for cloud with encryption
// config/filesystems.php
's3' => [
    'driver' => 's3',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION'),
    'bucket' => env('AWS_BUCKET'),
    'url' => env('AWS_URL'),
    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
    'throw' => false,
    'server_side_encryption' => 'AES256', // Encrypt at rest
],
```
