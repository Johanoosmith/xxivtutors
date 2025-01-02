<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script type="text/javascript" src="{{ URL::asset('backend/js/summernote-cleaner.js') }}"></script> 
<style>
.note-icon-caret::before {
	content: "";
}
.note-editable {
	background: #fff;
}
</style>
<script>   
    $(document).ready(function() {
        $('.summernote').summernote({                  
          tabsize: 2,
          height: 250,
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']] // Add the codeview button here
          ],
          cleaner:{
            action: 'both', 
            newline: '<br>', 
            icon: '<i class="fa fa-eraser"></i>',
            keepHtml: false,
            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], 
            keepClasses: false,
            badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'],
            badAttributes: ['style', 'start'],
            limitChars: false, 
            limitDisplay: 'both',
            limitStop: false
         }
        });
    });
</script>