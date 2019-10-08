function getAdminProduct(){
	$.ajax({
		url: "/api/product",
		method: "GET",
		dataType: "json",
		success: function(data, status) {
			var select = $("#product")
			select.html("<option>-- Choose Product --</option>")
			$.each(data, function(i, v) {
				$('<option value="'+v.id+'"></option>').html(v.title).appendTo(select)
			})
		}
	})
}

function getAdminCustomer(){
	$.ajax({
		url: "/api/customer",
		method: "GET",
		dataType: "json",
		success: function(data, status) {
			var select = $("#idcustomer")
			select.html("<option>-- Choose Customer --</option>")
			$.each(data, function(i, v) {
				$('<option value="'+v.id+'"></option>').html(v.name).appendTo(select)
			})
		}
	})
}

function getAdminGrid(){
	$.ajax({
		url: "/api/invoice",
		method: "GET",
		dataType: "json",
		success: function(data, status) {
			var tbody = $("#gridInvoice")
			tbody.empty()
			$.each(data, function(i, v) {
				if (v.product.length != "") {

					var ul = $('<ul class="list-unstyled"></ul>')
					var day = $('<ul class="list-unstyled"></ul>')
					var status = $('<ul class="list-unstyled"></ul>')
					var dateentry = $('<ul class="list-unstyled"></ul>')
					var dateissue = $('<ul class="list-unstyled"></ul>')
					var tr = $("<tr></tr>")
					tr.appendTo(tbody)
					
					$.each(v.product, function(index, val) {
						var date1 = moment(val.pivot.dateofentry)
						var date2 = moment(val.pivot.dateofissue)

						var countDay = date2.diff(date1, 'days')
						$("<li></li>").html(countDay+" Day").appendTo(day)
						$("<li></li>").html(val.pivot.status).appendTo(status)
						$("<li></li>").html(val.pivot.dateofentry).appendTo(dateentry)
						$("<li></li>").html(val.pivot.dateofissue).appendTo(dateissue)
						$("<li>"+val.title+"(Rp. "+val.pivot.total_price+",00)</li>").appendTo(ul)
					})
					$("<td></td>").html(i+1).appendTo(tr)
					$("<td></td>").html(v.name).appendTo(tr)
					$("<td></td>").html(ul).appendTo(tr)
					$("<td></td>").html(dateentry).appendTo(tr)
					$("<td></td>").html(dateissue).appendTo(tr)
					$("<td></td>").html(day).appendTo(tr)
					$("<td></td>").html(status).appendTo(tr)
					$("<td></td>").html('<a href="#" data-toggle="modal" data-target="#modalDetailInvoice" onclick="detailInvoice('+v.id+')">Detail</a> / <a href="#" data-toggle="modal" data-target="#modalInvoice" onclick="returnInvoice('+v.id+')">Return</a>').appendTo(tr)
				}
			})
		}
	})
}

function detailInvoice(id) {
	$.ajax({
		url : "/api/oneinvoice/"+id,
		method: "GET",
		dataType: "json",
		success: function(v, i) {
			$("#idcustomerdetail").val(v.id)
			$("#namedetail").val(v.name)
			$("#agedetail").val(v.age)
			$("#phonedetail").val(v.phone)
			$("#idcarddetail").val(v.identity_card)
			$("#addressdetail").val(v.address)
			var product = $("#gridDetailInvoice")
			product.empty()
			$.each(v.product, function(index, data) {
				var tr = $("<tr></tr>")
				tr.appendTo(product)

				$('<td></td>').html(data.id).appendTo(tr)
				$('<td></td>').html(data.title).appendTo(tr)
				$('<td></td>').html("Rp."+data.price+",00").appendTo(tr)
				$('<td></td>').html(data.stock).appendTo(tr)
				$('<td></td>').html(data.pivot.dateofentry).appendTo(tr)
				$('<td></td>').html(data.pivot.dateofissue).appendTo(tr)
				$('<td></td>').html("Rp."+data.pivot.total_price+",00").appendTo(tr)
				$('<td></td>').html(data.pivot.status).appendTo(tr)
			})			
		},
		error: function(v, i) {
			console.log(v, i)
		}
	})
}

function returnInvoice(id) {
	$.ajax({
		url: "/api/oneinvoice/"+id,
		method: "GET",
		dataType: "json",
		success: function(data, i) {
			var select = $("#idProduct")
			$("#customer_id").val(data.id)
			select.html("<option>-- Choose Product --</option>")
			$.each(data.product, function(i, v) {
				$('<option value="'+v.id+'"></option>').html(v.title).appendTo(select)
			})
		},
		error: function(v, i) {
			console.log(v, i)
		}
	})
}

function productCost(id) {
	$.ajax({
		url: "/api/oneproduct/"+id,
		method: "GET",
		dataType: "json",
		success: function(v, i) {
			$.each(v, function(index, data) {
				$.each(data.customer, function(index, val) {
					var dateentry = moment(val.pivot.dateofentry).format("YYYY-MM-DD")
					var dateissue = moment(val.pivot.dateofissue).format("YYYY-MM-DD")
					var datenow = moment().format("YYYY-MM-DD")
					var idcustomer = $("#customer_id").val()
					if (val.id == idcustomer) {
	
						$("#dateofentry").val(dateentry)
						$("#dateofissue").val(dateissue)
	
						var dateSubtract = moment(val.pivot.dateofissue).diff(datenow, "days")
						var fine
					console.log(fine)
						if (fine != 0) {
							fine = Math.abs(dateSubtract) * 5000
						}else {
							fine = 0
						}
						$("#totalCost").text(val.pivot.total_price + fine)
						$("#totalFine").text(fine)
					}
				})
			})
		},
		error: function(v, i) {
		}
	})
}

getAdminGrid()
$(document).ready(function() {
	$("#dateentry").val(moment().format("YYYY-MM-DD"))
	$("#unlockAdminInvoice").on('click', function(ev) {
		ev.preventDefault()
		$("#idcustomer").attr("readonly", false)
		$("#product").attr("readonly", false)
		$("#dateissue").attr("readonly", false)	
			
		getAdminProduct()
		getAdminCustomer()
	})

	$("#doPayment").on('click', function(ev) {
		ev.preventDefault()
		var idProduct = $("#idProduct").val()
		var totalCost = $("#totalCost").text()
		var payment = $("#payment").val()
		var customer_id = $("#customer_id").val()
		if(payment < totalCost) {
			Swal.fire({
			  type: 'error',
			  title: 'Payment is too lowest',
			  showConfirmButton: false,
			  timer: 1500
			})
		}else {
			var remain = payment - totalCost
			$.ajax({
				url: "/api/returninvoice/"+idProduct,
				method: "DELETE",
				data: {
					"product_id": idProduct,
					"customer_id": customer_id,
					"remaincost": remain,
					"totalcost": totalCost,
					"payment": payment
				},
				dataType: "json",
				success: function(v, i) {
					console.log(v, i)
					if (v.status == true) {
						getAdminGrid()		
						$("#modalInvoice").modal('hide')
						// Swal.fire({
						//   type: 'success',
						//   title: 'Invoice is return',
						//   showConfirmButton: false,
						//   timer: 1500
						// })
					}else {
						Swal.fire({
						  type: 'error',
						  title: v.message,
						  showConfirmButton: false,
						  timer: 1500
						})
					}
				},
				error: function(v, i) {
					console.log(v, i)
				}
			})
		}

	})

	$("#saveAdminInvoice").on("click", function(ev) {
		ev.preventDefault()

		var id = $("#idcustomer").val()
		var name = $("#name").val()
    	var age = $("#age").val()
    	var phone = $("#phone").val()
    	var idcard = $("#idcard").val()
    	var address = $("#address").val()
    	var product = $("#product").val()
    	var description = $("#description").val()
    	var price = $("#price").val()
    	var stock = $("#stock").val()
		var dateentry = $("#dateentry").val()
		var dateissue = $("#dateissue").val()

		var price = $("#price").val()
		var date1 = moment(dateentry)
		var date2 = moment(dateissue)

		var countDay = date2.diff(date1, 'days')
		if(countDay < 0) {
			alert("Do not kidding")
		}else {
			var totalPrice = countDay * price
			if(name == "" || age == "" || phone == "" || idcard == "" || address == "" || product == "" || description == "" || price == "" || stock == "" || dateentry == "" || dateissue == "") {
				Swal.fire({
				  type: 'error',
				  title: 'Data is not complete',
				  showConfirmButton: false,
				  timer: 1500
				})
			}else {
				var dataJson = {
					"customer_id": id,
					"product_id": product,
					"dateentry" : dateentry,
					"dateissue" : dateissue,
					"totalPrice" : totalPrice
				}
				$.ajax({
					url: "/api/invoice",
					method: "POST",
					dataType: "json",
					data: dataJson,
					success: function(v, i) {
							$("#idcustomer").find('option').remove().end()
							$("#product").find('option').remove().end()

							$("#name").val('')
							$("#age").val('')
							$("#phone").val('')
							$("#idcard").val('')
							$("#address").val('')
							
							$("#description").val('')
							$("#price").val('')
							$("#stock").val('')
							$("#dateissue").val('')
							
							$("#idcustomer").attr("readonly", true)
							
							$("#product").attr("readonly", true)
	
							$("#dateissue").attr("readonly", true)
							Swal.fire({
							  type: 'success',
							  title: 'Invoice is save',
							  showConfirmButton: false,
							  timer: 1500
							})	

							getAdminGrid()											
					},
					error: function(v, i) {
						console.log(v, i)
					}
				})
			}
		}
	})

	$("#product").on("change", function() {
		var id = this.value
		$.ajax({
			url: "/api/product/"+id,
			method: "GET",
			dataType: "json",
			success: function (data, status) {
				$("#description").val(data.description)
				$("#price").val(data.price)
				$("#stock").val(data.stock)
			}
		})
	})

	$("#idcustomer").on("change", function() {
		var id = this.value
		console.log(id)
		$.ajax({
			url: "/api/customer/"+id,
			method: "GET",
			dataType: "json",
			success: function (data, status) {
				console.log(data)
				$("#name").val(data.name)
				$("#age").val(data.age)
				$("#phone").val(data.phone)
				$("#idcard").val(data.identity_card)
				$("#address").val(data.address)
			}
		})
	})
})