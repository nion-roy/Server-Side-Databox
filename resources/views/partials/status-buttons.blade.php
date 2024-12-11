<select id="status" class="form-select" data-id="{{ $user->id }}" onchange="statusChange()">
	<option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
	<option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
</select>

<script>
	function statusChange() {
		let status = document.getElementById('status').value;
		let userId = document.getElementById('status').getAttribute('data-id');

		// Send AJAX request to update user status
		$.ajax({
			url: '/status/' + userId,
			type: 'POST',
			data: {
				"_token": "{{ csrf_token() }}",
				status: status,
				userId: userId
			},
			success: function(response) {
				console.log(response);
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}
</script>   
