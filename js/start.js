$(document).ready(function() {
	$("#signin").validate({
		submitHandler : function(form) {
			$('#start_btn').attr('disabled','disabled');
		    form.submit();
		},
		rules : {
			category : {
			    required : true
			},
			num_questions : {
				required : true
			}
		},
		messages : {
			category:{
<<<<<<< HEAD
                required : "Please choose your category to start Quiz"
           },
           num_questions : {
           	   required : "Please choose number of questions to be showed on each page"
=======
                required : "Hãy chọn môn thi để bắt đầu kiểm tra"
>>>>>>> 573fbedbdaf90d7a8bd353c09926f23c5a616591
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