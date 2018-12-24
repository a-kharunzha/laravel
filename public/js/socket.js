'use strict';

(function ($) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	var jBody = $('body');
	jBody.on('click','.js-add-count',function(){
		$.post('/socket/increment',function(response){
			if(response.success){
				// jBody.trigger('socket.incremented');		
			}
		},'json');
	});

}(jQuery));