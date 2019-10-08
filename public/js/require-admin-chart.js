$(document).ready(function() {
	var ctxDay = document.getElementById("amountDay").getContext('2d');
	var ctxProduct = document.getElementById("amountProduct").getContext('2d');
	function amountLoanToday() {
		var dataLabel = [];
		var dataChart = [];
		$.ajax({
			url: "/api/chart",
			method: "GET",
			dataType: "json",
			success: function(v, i) {
				var now = moment().format("Y-MM-DD")
				$.each(v, function(index, data) {
					dataLabel.push(data.title)
					var customerList = data.customer
					$.each(data.customer, function(index, data) {
						if(data.pivot.dateofentry != now) {
							console.log("Hari ini tidak ada peminjaman")
							return
						}else {
							dataChart.push(customerList.length)
							return
						}
					})
				});
				console.log(dataChart)
				var amountDay = new Chart(ctxDay, {
					type: "bar",
					data: {
						labels: dataLabel,
						datasets: [{
							label: "# of counts",
							data: dataChart,
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
			                	'rgba(54, 162, 235, 0.2)',
			                	'rgba(255, 206, 86, 0.2)'
							],
							borderColor: [
								'rgba(255, 99, 132, 1)',
			                	'rgba(54, 162, 235, 1)',
			                	'rgba(255, 206, 86, 1)'
			                ],
			                borderWith: 2
						}]
					},
					options: {
						scales: {
							yAxes: {
								ticks: {
									beginAtZero: true
								}
							}
						}
					}
				})		
			},
			error: function(v, i) {
				console.log(v, i)
			}
		})
		
	}
	function amountStockProduct() {
		$.ajax({
			url: "/api/product",
			method: "GET",
			dataType: "json",
			success: function(v, i) {
				var amountProduct = new Chart(ctxProduct, {
				type: "pie",
				data: {
					labels: [v[0].title, v[1].title, v[2].title],
					datasets: [{
						label: "# of counts",
						data: [v[0].stock, v[1].stock, v[2].stock],
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
		                	'rgba(54, 162, 235, 0.2)',
		                	'rgba(255, 206, 86, 0.2)'
						],
						borderColor: [
							'rgba(255, 99, 132, 1)',
		                	'rgba(54, 162, 235, 1)',
		                	'rgba(255, 206, 86, 1)'
		                ],
		                borderWith: 2
					}]
				},
				options: {
					scales: {
						yAxes: {
							ticks: {
								beginAtZero: true
							}
						}
					}
				}
				})
			}
		})
	}
	amountLoanToday()
	amountStockProduct()
})