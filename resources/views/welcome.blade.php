<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>DataTables Example</title>
		<!-- Include DataTables CSS -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	</head>

	<body>

		<div class="container">
			<div class="row">
				<div class="col-12 bg-success py-3 text-center rounded mt-2 mb-5">
					<h2 class="fw-bold text-white">Server Side Data With Yajra Databox</h2>
				</div>

				@session('success')
					<div class="col-12">
						<div class="alert alert-success" role="alert">
							<strong>Success! </strong>{{ session('success') }}
						</div>
					</div>
				</div>
			@endsession

			<div class="col-12">
				<table id="users-table" class="table table-striped table-hover data-table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>




		<!-- Include jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- Include DataTables JS -->
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script>
			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('users.index') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'name',
						name: 'name'
					},
					{
						data: 'email',
						name: 'email'
					},
					{
						data: 'created_at',
						name: 'created_at'
					},
					{
						data: 'action',
						name: 'action',
						orderable: false,
						searchable: false
					},
				]
			});
		</script>

	</body>

</html>
