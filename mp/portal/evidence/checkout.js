$(document).ready(function(){

	product();

	function product(){
		$.ajax({
			url	:	"checkout.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}

	$("body").delegate("#checkout1","click",function(event){
		var pid = $(this).attr("pid");
		var tid = $(this).attr("tid");
		var uid = $(this).attr("uid");
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "	checkout.php",
			method : "POST",
			data : {checkout1:1,proId:pid,proTitle:tid, proPort:uid},
			success : function(data){
				$('#product_msg').html(data);
				$('.overlay').hide();
			}
		})
	})

})
