<div class="container">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>STT</th>
				<th>Name</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($todosNew as $todo)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $todo->name }}</td>
				<td>{{ $todo->detail }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>