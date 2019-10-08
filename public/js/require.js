$(document).ready(function() {
	// ===========================================================================================
	//                                                Product
	// ===========================================================================================


	$("#dateentry").val(moment().format("YYYY-MM-DD"));
	function selectProduct() {
		$.ajax({
			url: "api/product",
			method: "GET",
			dataType: "json",
			success: function(v, i) {
				var product = $("#product");
				product.html("<option>-- Select Product --</option>");
				$.each(v, function(index, val) {
					$("<option value='"+val.id+"'>"+val.id+" - "+val.title+"</option>").appendTo(product)
				});
			},
			error: function(v, i) {
				console.log(v, i);
			}
		})
	}

	

	$("#product").change(function() {
		var id = this.value
		$.ajax({
			url: "api/product/"+id,
			method: "GET",
			dataType: "json",
			success: function(v, i) {
				$("#description").val(v.description)
				$("#price").val(v.price)
				$("#stock").val(v.stock)
			},
			error: function() {

			}
		})
	});

	selectProduct()
	$("#saveCustomer").click(function(ev) {
		ev.preventDefault();

		var name = $("#name").val();
		var age = $("#age").val();
		var phone = $("#phone").val();
		var idcard = $("#idcard").val();
		var product = $("#product").val();
		var address = $("#address").val();
		var description = $("#description").val();
		var price = $("#price").val();
		var idproduct = $("#product").val();
		var stock = $("#stock").val();
		var dateentry = $("#dateentry").val();
		var dateissue = $("#dateissue").val();
		var diffdays = moment(dateissue).diff(moment(dateentry), 'days');
		
		if(name == "" || age == "" || phone == "" || idcard == "" || product == "" || description == "" || price == "" || stock == "" || dateissue == "") {
			alert("Data is not be empty");
		}else {
			var dataJson = {
				"name" : name,
				"age" : age,
				"phone" : phone,
				"idcard" : idcard,
				"product" : product,
				"address" : address,
				"description" : description,
				"price" : price,
				"stock" : stock,
				"idproduct" : idproduct,
				"dateentry": dateentry,
				"dateissue" : dateissue,
				"costperday" : diffdays * price
			}
			$.ajax({
				url: "api/customer",
				method: "POST",
				data: dataJson,
				dataType : "json",
				success: function(v, i) {
					console.log(v, i)
				},
				error: function(v, i) {
					console.log(v, i)
				}
			})
		}
	});

})