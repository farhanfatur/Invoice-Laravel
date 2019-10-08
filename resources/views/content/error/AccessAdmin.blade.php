@extends("layouts.app")
@push("javascripts")
<script type="text/javascript">
	Swal.fire({
	  type: 'error',
	  title: 'You are not admin',
	  showConfirmButton: false,
	  timer: 1500
	}).then(function() {
		location.href = '/customer'
	})
</script>
@endpush
@section("content")
<!DOCTYPE html>
<html>
<head>
	<title>Danger</title>
</head>
<body>

</body>
</html>
@endsection
