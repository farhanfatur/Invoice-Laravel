// =========================================================================================
//                                Customer
// =========================================================================================

showCustomer()
$(document).ready(function() {
$("#unlockAdminCustomer").on('click', function(ev) {
	ev.preventDefault();

	$("#id").attr("readonly", false)
	$("#name").attr("readonly", false)
	$("#address").attr("readonly", false)
	$("#age").attr("readonly", false)
	$("#phone").attr("readonly", false)
	$("#idcard").attr("readonly", false)
	$("#email").attr("readonly", false)
	$("#password").attr("readonly", false)
	$("#confirmpassword").attr("readonly", false)	
})

$("#updateAdminCustomer").on('click', function(ev) {
	ev.preventDefault();

	var id = $("#id").val()
	var name = $("#name").val()
	var address = $("#address").val()
	var age = $("#age").val()
	var phone = $("#phone").val()
	var idcard = $("#idcard").val()
	var email = $("#email").val()
	var password = $("#password").val()
	var confirmpassword = $("#confirmpassword").val()	
	if(password != confirmpassword) {
		alert("Password is not same");
	}else {
		if(name == "" || address == "" || age == "" || idcard == "" || email == "" || password == "" || confirmpassword == "") {
			alert("Data is not be empty")
		}else {
			if(id != "" ) {
				var dataJson = {
					"id" : id,
					"name" : name,
					"address" : address,
					"age" : age,
					"phone": phone,
					"idcard" : idcard,
					"email" : email,
					"password" : password
				}

				$.ajax({
					url: "/api/customer/"+id,
					method: "PUT",
					dataType: "json",
					data: dataJson,
					success: function(v, i) {
						alert("Data is saved")
						$("#id").attr("readonly", true)
						$("#name").attr("readonly", true)
						$("#address").attr("readonly", true)
						$("#age").attr("readonly", true)
						$("#phone").attr("readonly", true)
						$("#idcard").attr("readonly", true)
						$("#email").attr("readonly", true)
						$("#password").attr("readonly", true)
						$("#confirmpassword").attr("readonly", true)

						$("#id").val("")
						$("#name").val("")
						$("#address").val("")
						$("#age").val("")
						$("#phone").val("")
						$("#idcard").val("")
						$("#email").val("")
						$("#password").val("")
						$("#confirmpassword").val("")
						showCustomer()
					
					},
					error: function(v, i) {
						console.log(v, i)
					}
				})
			}else {
				alert("Data should be updated, Insert Data First")
			}
		}
	}
})



$("#saveAdminCustomer").on('click', function(ev) {
	ev.preventDefault();

	var id = $("#id").val()
	var name = $("#name").val()
	var address = $("#address").val()
	var age = $("#age").val()
	var phone = $("#phone").val()
	var idcard = $("#idcard").val()
	var email = $("#email").val()
	var password = $("#password").val()
	var confirmpassword = $("#confirmpassword").val()

	if(password != confirmpassword) {
		alert("Password is not same");
	}else {
	if(name == "" || address == "" || age == "" || idcard == "" || email == "" || password == "" || confirmpassword == "") {
		alert("Data is not be empty")
	}else {
		if(id == "") {
			var dataJson = {
				"id" : id,
				"name" : name,
				"address" : address,
				"age" : age,
				"phone": phone,
				"idcard" : idcard,
				"email" : email,
				"password" : password
			}

			$.ajax({
				url: "/api/customer",
				method: "POST",
				dataType: "json",
				data: dataJson,
				success: function(v, i) {
					if(i == "success") {
						alert("Data is saved")
						$("#id").attr("readonly", true)
						$("#name").attr("readonly", true)
						$("#address").attr("readonly", true)
						$("#age").attr("readonly", true)
						$("#phone").attr("readonly", true)
						$("#idcard").attr("readonly", true)
						$("#email").attr("readonly", true)
						$("#password").attr("readonly", true)
						$("#confirmpassword").attr("readonly", true)

						$("#id").val("")
						$("#name").val("")
						$("#address").val("")
						$("#age").val("")
						$("#phone").val("")
						$("#idcard").val("")
						$("#email").val("")
						$("#password").val("")
						$("#confirmpassword").val("")
						showCustomer()
					}
				},
				error: function(v, i) {
					console.log(v, i)
				}
			})
		}else {
			alert("Data should be save")
		}
	}
	}
});

});

function showCustomer() {
	$.ajax({
		url: "/api/customer",
		method: "GET",
		dataType: "json",
		success: function(v, i) {
			var $tbody = $("#gridCustomer");
			$tbody.empty();
			$("#id").attr("readonly", true)
			$("#name").attr("readonly", true)
			$("#address").attr("readonly", true)
			$("#age").attr("readonly", true)
			$("#phone").attr("readonly", true)
			$("#idcard").attr("readonly", true)
			$("#email").attr("readonly", true)
			$("#password").attr("readonly", true)
			$("#confirmpassword").attr("readonly", true)

			$.each(v, function(index, val) {
				var $tr = $("<tr></tr>")
				$tr.appendTo($tbody)
				$("<td></td>").html(index+1).appendTo($tr);
				$("<td></td>").html(val.name).appendTo($tr);
				$("<td></td>").html(val.age).appendTo($tr);
				$("<td></td>").html(val.address).appendTo($tr);
				$("<td></td>").html(val.identity_card).appendTo($tr);
				$("<td></td>").html('<a href="#" onclick="showAdminCustomer(\''+val.id+'\')">Edit</a> / <a href="#" onclick="deleteAdminCustomer(\''+val.id+'\')">Delete</a>').appendTo($tr);
			})
		},
		error: function(v, i) {
			console.log(v, i)
		}
	})
}

function showAdminCustomer(id) {
	$("#id").attr("readonly", false)
	$("#name").attr("readonly", false)
	$("#address").attr("readonly", false)
	$("#age").attr("readonly", false)
	$("#phone").attr("readonly", false)
	$("#idcard").attr("readonly", false)
	$("#email").attr("readonly", false)
	$("#password").attr("readonly", false)
	$("#confirmpassword").attr("readonly", false)

	$.ajax({
		url: "/api/customer/"+id+"/edit",
		method: "GET",
		dataType: "json",
		success: function(v, i) {
			console.log(v.user.password)
			$("#id").val(v.id)
			$("#name").val(v.name)
			$("#address").val(v.address)
			$("#age").val(v.age)
			$("#phone").val(v.phone)
			$("#idcard").val(v.identity_card)
			$("#email").val(v.user.email)
		},
		error: function(v, i) {
			console.log(v, i)
		}
	})
}

function deleteAdminCustomer(id) {
	$.ajax({
		url: "/api/customer/"+id,
		method: "DELETE",
		dataType: "json",
		success: function(v, i) {
			alert("Data is remove")
			showCustomer()
		},
		error: function(v, i) {
			console.log(v, i)
		}
	})
}
