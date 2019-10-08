<table>
	<tr>
		<th>Name</th><th>Age</th><th>Address</th><th>Identity Card</th><th>Email</th><th>Date of entry</th><th>Date of Issue</th><th>Product</th><th>Fine</th><th>Total Price</th><th>Status</th>
	</tr>
	@foreach($customers as $customer)
	<tr>
		<td>{{ $customer->name }}</td><td>{{ $customer->age }}</td><td>{{ $customer->address }}</td><td>{{ $customer->identity_card }}</td><td>{{ $customer->user->email }}</td>
		<td>
			<ul>
				@foreach($customer->product as $product)
					<li>{{ $product->pivot->dateofentry }}</li>
				@endforeach
			</ul>
		</td>
		<td>
			<ul>
				@foreach($customer->product as $product)
					<li>{{ $product->pivot->dateofissue }}</li>
				@endforeach
			</ul>
		</td>
		<td>
			<ul>
				@foreach($customer->product as $product)
					<li>{{ $product->title }}</li>
				@endforeach
			</ul>
		</td>
		<td>
			<ul>
				@foreach($customer->product as $product)
					@php
						$diffDay = Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays($product->pivot->dateofissue)
					@endphp
					@if($diffDay < 0) 
						<li>{{ $diffDay * 5000 }}</li>
					@else
						<li>0</li>
					@endif
				@endforeach
			</ul>
		</td>
		<td>
			<ul>
				@foreach($customer->product as $product)
					@php
						$diffDay = Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays($product->pivot->dateofissue)
					@endphp
					@if($diffDay < 0) 
						<li>{{ $product->pivot->total_price +($diffDay * 5000) }}</li>
					@else
						<li>{{ $product->pivot->total_price }}</li>
					@endif
				@endforeach
			</ul>
		</td>
		<td>
			<ul>
				@foreach($customer->product as $product)
					@if($product->pivot->status == "not return")
						<li>Not Return</li>
					@else
						<li>Return</li>
					@endif
				@endforeach
			</ul>
		</td>
	</tr>
	@endforeach
</table>