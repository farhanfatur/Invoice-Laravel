// =========================================================================================
//                                         Product
// =========================================================================================
showProduct()
$(document).ready(function() {

	$("#editAdminProduct").on('click', function(ev) {
		ev.preventDefault();
		$("#id").attr("readonly", true)
		$("#title").attr("readonly", true)
		$("#price").attr("readonly", true)
		$("#stock").attr("readonly", true)
		$("#desc").attr("readonly", true)
	});

	$("#unlockAdminProduct").on('click', function(ev) {
		ev.preventDefault();
		$("#id").attr("readonly", false)
		$("#title").attr("readonly", false)
		$("#price").attr("readonly", false)
		$("#stock").attr("readonly", false)
		$("#desc").attr("readonly", false)
	});

	$("#saveAdminProduct").on('click', function(ev) {
		ev.preventDefault();

		var id = $("#id").val()
		var title = $("#title").val()
		var price = $("#price").val()
		var stock = $("#stock").val()
		var desc = $("#desc").val()

		if (title == "" || price == "" || stock == "" || desc == "") {
			alert("Data is not be empty!");
		}else {
			if(id == "") {
				var dataJson = {
					"title": title,
					"price": price,
					"stock": stock,
					"desc": desc
				}
				$.ajax({
					url: "/api/product",
					method: "POST",
					dataType: 'json',
					data: dataJson,
					success: function(v, i) {
						if(i == "success") {
							alert("Data is save")
							showProduct()
							$("#id").val("")
							$("#title").val("")
							$("#price").val("")
							$("#stock").val("")
							$("#desc").val("")

							$("#id").attr("readonly", true)
							$("#title").attr("readonly", true)
							$("#price").attr("readonly", true)
							$("#stock").attr("readonly", true)
							$("#desc").attr("readonly", true)
						}
					},
					error: function(v, i) {
						console.log(v, i)
					}
				})
			}else {
				alert("Data must be save")
			}
		}
	});

	$("#udpateAdminProduct").on('click', function(ev) {
		ev.preventDefault();

		var id = $("#id").val()
		var title = $("#title").val()
		var price = $("#price").val()
		var stock = $("#stock").val()
		var desc = $("#desc").val()

		if (id == "" || title == "" || price == "" || stock == "" || desc == "") {
			alert("Data is not be empty!");
		}else {
			if(id != "") {
				var dataJson = {
					"id": id,
					"title": title,
					"price": price,
					"stock": stock,
					"desc": desc
				}
				console.log(dataJson)
				$.ajax({
					url: "/api/product/"+id,
					method: "PUT",
					dataType: 'json',
					data: dataJson,
					success: function(v, i) {
						if (i == "success") {
							alert("Data is updated")
							showProduct()
							$("#id").val("")
							$("#title").val("")
							$("#price").val("")
							$("#stock").val("")
							$("#desc").val("")

							$("#id").attr("readonly", true)
							$("#title").attr("readonly", true)
							$("#price").attr("readonly", true)
							$("#stock").attr("readonly", true)
							$("#desc").attr("readonly", true)
						}
					},
					error: function(v, i) {
						console.log(v, i)	
					}

				})
			}else {
				alert("Data must be update")
			}
		}
	})
})

function showProduct() {
	$.ajax({
		url: "/api/product",
		method: "GET",
		dataType: "json",
		success: function(v, i) {
			var $tbody = $("#gridProduct");
			$tbody.empty();
			$("#id").attr("readonly", true)
			$("#title").attr("readonly", true)
			$("#price").attr("readonly", true)
			$("#stock").attr("readonly", true)
			$("#desc").attr("readonly", true)
			$.each(v, function(index, val) {
				var $tr = $("<tr></tr>")
				$tr.appendTo($tbody)
				$("<td></td>").html(index+1).appendTo($tr);
				$("<td></td>").html(val.title).appendTo($tr);
				$("<td></td>").html(val.description).appendTo($tr);
				$("<td></td>").html(val.price).appendTo($tr);
				$("<td></td>").html(val.stock).appendTo($tr);
				$("<td></td>").html('<a href="#" onclick="showAdminProduct(\''+val.id+'\')">Edit</a> / <a href="#" onclick="deleteAdminProduct(\''+val.id+'\')">Delete</a>').appendTo($tr);
			})
		}
	})
}

function showAdminProduct(id) {
	$("#id").attr("readonly", false)
	$("#title").attr("readonly", false)
	$("#price").attr("readonly", false)
	$("#stock").attr("readonly", false)
	$("#desc").attr("readonly", false)

	$.ajax({
		url: "/api/product/"+id+"/edit",
		method: "GET",
		dataType: "json",
		success: function(v, i) {
			$("#id").val(v.id)
			$("#title").val(v.title)
			$("#price").val(v.price)
			$("#stock").val(v.stock)
			$("#desc").val(v.description)
		},
		error: function(v, i) {
			console.log(v, i)
		}
	})
}
function deleteAdminProduct(id) {
$.ajax({
	url: "/api/product/"+id,
	method: "DELETE",
	dataType: "json",
	success: function(v, i) {
		if(i == "success") {
			alert("Data is remove");
			showProduct()
		}
	},
	error: function(v, i) {
		console.log(v, i)
	}
})
}