$(document).ready(function(){

	$(".register-btn").on("click", function(){

		$.ajax({
			url : '../classes/Credentials.php',
			method : "POST",
			data : $("#admin-register-form").serialize(),
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#admin-register-form").trigger("reset");
					window.location.href = window.origin+"/mp/admin/portal/index.php";
					$(".message").html('<span class="text-success">'+resp.message+'</span>');
				}else if(resp.status == 303){
					$(".message").html('<span class="text-danger">'+resp.message+'</span>');
				}
			}
		});

	});

	$(".login-btn").on("click", function(){

		$.ajax({
			url : '../classes/Credentials.php',
			method : "POST",
			data : $("#admin-login-form").serialize(),
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#admin-login-form").trigger("reset");
				window.location.href = window.origin+"/mp/admin/portal/index.php";
				}else if(resp.status == 303){
					$(".message").html('<span class="text-danger">'+resp.message+'</span>');
				}
			}
		});

	});

});
