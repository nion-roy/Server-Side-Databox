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
				@endsession

				<div class="col-12">
					<table id="users-table" class="table table-striped table-hover data-table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Created At</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>


		<!-- Include jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- Include DataTables JS -->
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

		<script>
			$(function() {
				$('#users-table').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{!! route('users.retrieved') !!}",
					columns: [{
							data: 'id',
							name: 'id'
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
							data: 'status',
							name: 'status',
							orderable: false,
							searchable: false
						},
						{
							data: 'actions',
							name: 'actions',
							orderable: false,
							searchable: false
						}
					]
				});

				// Handle view
				$(document).on('click', '.view-user', function() {
					const userId = $(this).data('id');
					$.get(`/users/${userId}/view`, function(response) {
						alert(`User details: ${JSON.stringify(response)}`);
					});
				});

				// Handle edit
				$(document).on('click', '.edit-user', function() {
					const userId = $(this).data('id');
					// Open modal or redirect to edit form
					alert(`Edit user with ID: ${userId}`);
				});

				// Handle delete
				$(document).on('click', '.delete-user', function() {
					const userId = $(this).data('id');
					if (confirm('Are you sure you want to delete this user?')) {
						$.ajax({
							url: `/users/${userId}/delete`,
							type: 'DELETE',
							success: function(response) {
								alert(response.success);
								$('#users-table').DataTable().ajax.reload();
							},
							error: function() {
								alert('Failed to delete user.');
							}
						});
					}
				});
			});
		</script>

		@stack('js')


		{{-- this code will be working --}}
		{{-- <script>
			$(function() {
				$('#users-table').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{!! route('users.retrieved') !!}",
					columns: [{
							data: 'id',
							name: 'id'
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
							data: 'id', // Action column
							name: 'actions',
							orderable: false,
							searchable: false,
							render: function(data, type, row) {
								return `
                            <button class="btn btn-primary btn-sm view-user" data-id="${data}">View</button>
                            <button class="btn btn-success btn-sm edit-user" data-id="${data}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-user" data-id="${data}">Delete</button>
                        `;
							}
						}
					]
				});

				// Handle view action
				$(document).on('click', '.view-user', function() {
					let userId = $(this).data('id');
					alert(`View user with ID: ${userId}`);
					// You can redirect or open a modal here
				});

				// Handle edit action
				$(document).on('click', '.edit-user', function() {
					let userId = $(this).data('id');
					alert(`Edit user with ID: ${userId}`);
					// Redirect to edit page or open edit modal
				});

				// Handle delete action
				$(document).on('click', '.delete-user', function() {
					let userId = $(this).data('id');
					if (confirm('Are you sure you want to delete this user?')) {
						// Send an AJAX request to delete the user
						$.ajax({
							url: `/users/${userId}/delete`,
							type: 'DELETE',
							success: function(response) {
								alert('User deleted successfully');
								$('#users-table').DataTable().ajax.reload(); // Reload table
							},
							error: function(xhr) {
								alert('Failed to delete the user');
							}
						});
					}
				});
			});
		</script> --}}



		{{-- <script>
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
		</script> --}}

	</body>

</html>
