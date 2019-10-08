$(document).ready(function() {
	// $("#exportToExcel").on('click', function() {
	// 	var option = $("#reportmenu").val()
	// 	var firstdate = $("#firstdate").val()
	// 	var lastdate = $("#lastdate").val()
	// 	var csrf = $("[name=_token]").val()
	// 	if (option == "productpermonth") {
	// 		if(firstdate == "" || lastdate == "") {
	// 			Swal.fire({
	// 			  type: 'error',
	// 			  title: 'Date is Empty',
	// 			  text: 'First Date or Last Date is not be empty',
	// 			  showConfirmButton: false,
	// 			  timer: 1500
	// 			})
	// 		}else {
	// 			var dataJson = {
	// 				"firstdate": firstdate,
	// 				"lastdate": lastdate
	// 			}
	// 			$.ajax({
	// 				headers: {
	// 				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 				 },
	// 				url : "api/productreport",
	// 				data: dataJson,
	// 				method: "POST",
	// 				success: function(v, i) {
	// 					console.log(v.url)
	// 					// window.location.href= v
	// 				},
	// 				error: function(v, i) {
	// 					console.log(v, i)
	// 				}
	// 			})
	// 		}
	// 	}
	// })
})