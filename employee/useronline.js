// global the manage memeber table 
var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": "user_retrieve.php"
	});

	$("#addMemberModalBtn").on('click', function() {
		// reset the form 
		$("#createMemberForm")[0].reset();
		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".messages").html("");

		// submit form
		$("#createMemberForm").unbind('submit').bind('submit', function() {

			$(".text-danger").remove();

			var form = $(this);

			// validation
			var name = $("#name").val();
			var password = $("#password").val();
			var comment = $("#comment").val();
            var profile = $("#profile").val();
            var limituptime = $("#limituptime").val();

			if(name == "") {
				$("#name").closest('.form-group').addClass('has-error');
				$("#name").after('<p class="text-danger">The Name field is required</p>');
			} else {
				$("#name").closest('.form-group').removeClass('has-error');
				$("#name").closest('.form-group').addClass('has-success');				
			}

			if(password == "") {
				$("#password").closest('.form-group').addClass('has-error');
				$("#password").after('<p class="text-danger">The Password field is required</p>');
			} else {
				$("#password").closest('.form-group').removeClass('has-error');
				$("#password").closest('.form-group').addClass('has-success');				
			}

			if(comment == "") {
				$("#comment").closest('.form-group').addClass('has-error');
				$("#comment").after('<p class="text-danger">The Comment field is required</p>');
			} else {
				$("#comment").closest('.form-group').removeClass('has-error');
				$("#comment").closest('.form-group').addClass('has-success');				
			}

			if(profile == "") {
				$("#profile").closest('.form-group').addClass('has-error');
				$("#profile").after('<p class="text-danger">The Profile field is required</p>');
			} else {
				$("#profile").closest('.form-group').removeClass('has-error');
				$("#profile").closest('.form-group').addClass('has-success');				
            }
            
            if(limituptime == "") {
				$("#limituptime").closest('.form-group').addClass('has-error');
				$("#limituptime").after('<p class="text-danger">The Limit Up-Time field is required</p>');
			} else {
				$("#limituptime").closest('.form-group').removeClass('has-error');
				$("#limituptime").closest('.form-group').addClass('has-success');				
			}

			if(name && password && comment && profile && limituptime) {
				//submit the form to server
				$.ajax({
					url : form.attr('action'),
					type : form.attr('method'),
					data : form.serialize(),
					dataType : 'json',
					success:function(response) {

						// remove the error 
						$(".form-group").removeClass('has-error').removeClass('has-success');

						if(response.success == true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// reset the form
							$("#createMemberForm")[0].reset();		

							// reload the datatables
							manageMemberTable.ajax.reload(null, false);
							// this function is built in function of datatables;

						} else {
							$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
						}  // /else
					} // success  
				}); // ajax subit 				
			} /// if


			return false;
		}); // /submit form for create member
	}); // /add modal

});