<table>
	<tr>
		<th colspan="7">
			<h1 align="center">Customer Report</h1>
		</th>
	</tr>
	<tr>
		<th>Name</th><th>Age</th><th>Phone</th><th>Address</th><th>Identity Card</th><th>Email</th><th>Loan Amount</th>
	</tr>
	@foreach($customers as $customer)
	<tr>
		<td>{{$customer->name}}</td><td>{{ $customer->age }}</td><td>{{ $customer->phone }}</td><td>{{ $customer->address }}</td><td>{{ $customer->identity_card }}</td><td>{{ $customer->user->email }}</td><td>{{ count($customer->product) }} Product</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="7">Count Customer : {{ count($customers) }}</td>
	</tr>
</table>