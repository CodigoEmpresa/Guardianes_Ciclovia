$(function()
{
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document)
	.ajaxStart(function(){
		console.log('start ajax');
	    $('div.ajaxloader').fadeIn();
	})
	.ajaxStop(function(){
	    $('div.ajaxloader').fadeOut();
	});

	$('body').tooltip({
	    selector: '[data-toggle="tooltip"]'
	});

	$('body').delegate('input[type="text"][data-number]', 'keypress', function(event) {
    	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});



    //utilidades de formularios
	$('select').each(function(i, e){
	  	if ($(this).attr('data-value'))
	  	{
	      	if ($.trim($(this).data('value')) !== '')
	      	{
	          	var dato = $(this).data('value');
	          	$(this).val(dato);
	      	}
	  	}
	  	$(this).trigger('change');
	});

	$('table.default').DataTable({
		responsive: true,
		columnDefs: [
			{
				targets: 'no-sort', 
				orderable: false
			}
		]
	});
});