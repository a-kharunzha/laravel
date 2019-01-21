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
				jBody.trigger('doUpdateCounter',[response.newValue]);	
			}
		},'json');
	});
	console.log('111');
	Echo.channel('socket')
	    // .listen('App\\Events\\SocketIncremented', (e) => {
	    .listen('SocketIncremented', (e) => {
			console.log(e);
			jBody.trigger('doUpdateCounter',[e.data.newValue]);
		});
	
	jBody.on('doUpdateCounter',function(e,newValue){
		$('.js-counter').text(newValue);
	});

}(jQuery));