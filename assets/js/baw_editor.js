$(document).ready(function(e) {	
//editor
	$('#summernote').summernote({
	  height: 150,
	  toolbar: [
	  	['style', ['style']],
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],		
		['link', ['link']],
		['help', ['help']]
	  ]
	});
});