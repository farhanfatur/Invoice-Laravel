function getProduct(){
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
$(document).ready(function() {

	var id = $("#id").val()
	$.ajax({
		url: "/api/invoice/"+id,
		method: "GET",
		dataType: "json",
		success: function(data, status) {
			$("#name").val(data.name)
			$("#age").val(data.age)
			$("#phone").val(data.phone)
			$("#idcard").val(data.identity_card)
			$("#address").val(data.address)
		},
		error: function(data, status) {
			console.log(data, status)
		}
	})

$("#dateentry").val(moment().format("YYYY-MM-DD"))
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
$("#saveInvoiceCustomer").on("click", function(ev) {
	ev.preventDefault()
	var id = $("#id").val()
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

		if (name == "" || age == "" || phone == "" || idcard == "" || address == "" || product == "" || description == "" || price == "" || stock == "" || dateentry == "" || dateissue == "") {
			alert("Data is empty, please contact to admin")
		}else {
			var dataJson = {
				"user_id": id,
				"product_id": product,
				"dateentry" : dateentry,
				"dateissue" : dateissue,
				"totalPrice" : totalPrice
			}
			Swal.fire({
			  title: 'Your stuff will be send, Do you want it again?',
			  text: "Ofourse you do, but you should has a lot money!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, i want!'
			}).then((result) => {
			  if (result.value) {
			    $.ajax({
					url : "/api/invoice",
					method: "POST",
					data: dataJson,
					dataType: "json",
					success: function(data, status) {
						Swal.fire({
						  type: 'success',
						  title: "Your mind it\'s your bussiness",
						  showConfirmButton: false,
						  timer: 1500
						})
						$("#product").val("")
					    $("#description").val("")
						$("#price").val("")
						$("#stock").val("")
						$("#dateissue").val("")
					},
					error: function(data, status) {
						console.log(data, status)
					}
				})
			  }else {
			  	$.ajax({
				url : "/api/invoice",
					method: "POST",
					data: dataJson,
					dataType: "json",
					success: function(data, status) {
						Swal.fire({
						  type: 'success',
						  title: 'Becarefull to your loan items',
						  showConfirmButton: false,
						  timer: 1500
						})

						location.href = '/logout'
					},
					error: function(data, status) {
						console.log(data, status)
					}
				})
			  }
			})
			
		}
	}
})
})

getProduct()