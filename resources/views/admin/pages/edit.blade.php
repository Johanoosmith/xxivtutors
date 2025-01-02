@extends('layouts.admin')
@section('title') Update Page @endsection
@section('inline-css')
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Update Page Detail</h5>
        </div>
        <div class="card-body">
        {{ html()->modelForm($page,'PATCH',route('admin.pages.update',$page->id))->class('validatedForm')->id('page_form')->attribute('enctype', 'multipart/form-data')->open() }}
            {{ csrf_field() }}
            @include('includes.admin.page.edit_form')
        {{ html()->form()->close() }}
        </div>
    </div>
	
@endsection
@section('inline-js')
<style>
/*.ck-editor__editable_inline {
    min-height: 300px;
}
*/
</style> 
@include('includes.admin.summernote') 
<script>   

    /*ClassicEditor.create( document.querySelector( '#description' ),{
        ckfinder: {          
            uploadUrl: "{{route('admin.upload').'?_token='.csrf_token()}}",
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        }
    });
    */

    $(document).ready(function() {
            $.validator.addMethod('filesize', function(value, element, param) {
             return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than 2 MB');

            $('#page_form').validate({
                rules: {
                    "image": {
                        filesize: 2097152 // <- 2 MB
                    },
                },
                
                messages: {
                    "image": { maxFileSize: 'The file selected is too large.'}, 
                   
                }
            });
    });
</script> 
<script>
	$(document).on('change','#page_template',function(){
       getPageForm();
   });
   
    function getPageForm(){
       var val     = $('#page_template').val();      
       var edit    = {{ isset($edit) ? 1 : 0 }};
       if(val){
           $.ajax({
               url : "{{ route('admin.pages.getform') }}",
               type: 'post',
               data: {
				    "_token": "{{ csrf_token() }}",
					page_slug : val,
					edit : edit},
               dataType : 'json',              
               success : function(res){                  
                   $('.form-fields').html(res.html); 
                  
                   $('.form-fields').html(res.html);                    
                  
               }
           });
       }
   }


	function confirmation(e) {
        e.preventDefault();
        var url = e.currentTarget.getAttribute('href');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            text: 'If you delete this, it will be removed forever.',
            showCancelButton: true,
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#a8dab5',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel please!",
            dangerMode: true,
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    }



/** privacy page faqs start */

// faq section start
$(document).on('click', '.addmore_faq', function() {
		var numItems = $('.removemore_faq').length
		if(numItems < 11){
		var form = $(this).closest('form');
		var section = form.find('.faqsection:last-child');
		var index = section.data('index');
		var newIndex = index + 1;
		var newSection = section.clone();
		
		newSection.find('input').val('');
		newSection.find('textarea').val('');
		newSection.data('index', newIndex);
		newSection.attr('data-index', newIndex);
			

		if ( newSection.find('.removemore_faq').length === 0 ) {
			newSection.find('.action-js').append('<button type="button" class="btn btn-danger removemore_faq"> <i class="fa fa-trash"></i> </button>'             );
		
			}
		if ( newSection.find('.addmore_faq').length > 0 ) {
				newSection.find('.addmore_faq').remove();
		}
				
		updateAttributes(newSection, 'question', index);
		updateAttributes(newSection, 'answer', index);		   
		newSection.insertAfter(section);

		}else{				
				Swal.fire({
					icon: 'warning',
					title: 'Only add 10 faqs',  					
				});   
		}	  
   })

   $(document).on('click', '.removemore_faq', function() { 
	   var section = $(this).closest('.faqsection');
	   section.remove();
   });

   function updateAttributes( newSection, key, index ) {
		var section = newSection.find(`[name="faqs[${index}][${key}]"]`);
		//console.log(section);
		section.attr('name', `faqs[${index+1}][${key}]`);
		section.attr('id', `${key}_${index+1}`);
   }

/** privacy page faqs end */
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(function () {
        $('select2').each(function () {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
    });
</script>

@endsection