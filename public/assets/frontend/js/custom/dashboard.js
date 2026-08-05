'use strict';

/* TinyMCE init */
tinymce.init({
  selector: 'textarea#editor',
  license_key: 'gpl',
  plugins: 'autolink link image lists table',
  menubar: 'file edit view insert format tools table',
  toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image table',
  height: 400,
  toolbar_mode: 'sliding',
  contextmenu: 'link image table',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
  file_picker_callback: function (callback, value, meta) {
    // Create input element and trigger click
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function () {
      var file = this.files[0];

      // You can add your image upload logic here
      // For example, using FileReader to preview:
      var reader = new FileReader();
      reader.onload = function () {
        callback(reader.result, {
          alt: file.name
        });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  }
});
