$(document).ready(function(){
	
	$("#register-form").validate({
		submitHandler : function(e) {
		    $(form).submit();
		},
		rules : {
			name : {
				required : true
			},
			email : {
				required : true,
				email: true,
				remote: {
					url: "check-email.php",
					type: "post",
					data: {
						email: function() {
							return $( "#email" ).val();
						}
					}
				}
			},
			password : {
				required : true
			},
			confirm_password : {
				required : true,
				equalTo: "#password"
			}
		},
		messages : {
			name : {
				required : "Hãy nhập tên"
			},
			email : {
				required : "Hãy nhập email",
				remote : "Email đã tồn tại"
			},
			password : {
				required : "Hãy nhập mật khẩu"
			},
			confirm_password : {
				required : "Hãy xác nhận mật khẩu",
				equalTo: "Mật khẩu và xác nhận mật khẩu không trùng khớp"
			}
		},
		errorPlacement : function(error, element) {
			$(element).closest('div').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('div').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			 $(element).closest('div').removeClass('has-error').addClass('has-success');
			 $(element).closest('div').find('.help-block').html('');
		}
	});
	
	
});