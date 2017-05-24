$(document).ready(function() {
	$("#signin").validate({
		submitHandler : function(form) {
			$('#start_btn').attr('disabled','disabled');
		    form.submit();
		},
		rules : {
			name : {
				required : true,
				minlength : 3,
				remote : {
					url : "check_name.php",
					type : "post",
					data : {
						username : function() {
							return $("#name").val();
						}
					}
				}
			},
			category : {
			    required : true
			}
		},
		messages : {
			name : {
				required : "Please enter your name",
				remote : "Name is already taken, Please choose some other name"
			},
			category:{
                required : "Please choose your category to start Quiz"
           	}
		},
		errorPlacement : function(error, element) {
			$(element).closest('.form-group').find('.help-block').html(error.html());
		},
		highlight : function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		}
	});
	$('#form-add-question').submit(function(){
 
        // BƯỚC 1: Lấy dữ liệu từ form
        var question_name    = $.trim($('#question_name').val());
        var answer1    = $.trim($('#answer1').val());
        var answer2    = $.trim($('.answer2').val());
        var answer3    = $.trim($('.answer3').val());
        var answer4    = $.trim($('.answer4').val());
        var answer5    = $.trim($('.answer5').val());
        var answer6    = $.trim($('.answer6').val());
        var answer     = $.trim($('.answer').val());
 
        // BƯỚC 2: Validate dữ liệu
        // Biến cờ hiệu
        var flag = true;
 
        if (question_name == ''){
            $('#question_name_error').text('Chưa nhập nội dung câu hỏi');
            flag = false;
        }
        else{
            $('#question_name_error').text('');
        }

        if (answer1 == '' || answer2 == ''){
            $('#answer_error').text('Nhập ít nhất nội dung hai câu lựa chọn');
            flag = false;
        }
        else{
            $('#answer_error').text('');
        }

        if (answer3 == '' && answer4 != ''){
            $('#first_error').text('Nhập nội dung lựa chọn 3 trước');
            flag = false;
        }
        else{
            $('#first_error').text('');
        }

        if (answer4 == '' && answer5 != ''){
            $('#first_error').text('Nhập nội dung lựa chọn 4 trước');
            flag = false;
        }
        else{
            $('#first_error').text('');
        }

        if (answer5 == '' && answer6 != ''){
            $('#first_error').text('Nhập nội dung lựa chọn 5 trước');
            flag = false;
        }
        else{
            $('#first_error').text('');
        }
 
        if (answer == ''){
            $('#answer0_error').text('Nhập đáp án đúng của câu hỏi');
            flag = false;
        }
        else{
            $('#answer0_error').text('');
        }
 
        return flag;
    });
});