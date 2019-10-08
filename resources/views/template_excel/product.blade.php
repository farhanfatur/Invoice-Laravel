<table>
	<tr>
		<th colspan="8">
			<h1 align="center">Product Report</h1>
		</th>
	</tr>
	<tr>
		<th>Title</th><th>Description</th><th>Price</th><th>Stock</th>
	</tr>
	@foreach($products as $product)
	<tr>
		<td>{{$product->title}}</td><td>{{$product->description}}</td><td>{{$product->price}}</td><td>{{$product->stock}}</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="4">Count Product : {{ count($products) }}</td>
	</tr>
	<tr>
		<td colspan="4">Highest Stock Product: {{ $products->max("stock") }}</td>
	</tr>
	<tr>
		<td colspan="4">lowest Stock Product: {{ $products->min("stock") }}</td>
	</tr>
</table>