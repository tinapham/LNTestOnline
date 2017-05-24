$(document).ready(function() {
	$("#signin").validate({
		submitHandler : function(form) {
			$('#start_btn').attr('disabled','disabled');
		    form.submit();
		},
		rules : {
			category : {
			    required : true
			}
		},
		messages : {
			category:{
                required : "Hãy chọn môn thi để bắt đầu kiểm tra"
           }
		},
		errorPlacement : function(error, element) {
			$(element).closest('.form-group').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		}
	});
});