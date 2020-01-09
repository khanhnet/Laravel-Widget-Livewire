@if($this->isOpen==1)
<div class="modal" style="display: block" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Todo</h5>
			</div>
			<div class="modal-body">
				<form wire:submit.prevent="create">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" wire:model="name">
					</div>
					@error('name') <p class="text-danger">{{ $message }}</p> @enderror
					<div class="form-group">
						<label>Detail</label>
						<input type="text" class="form-control" wire:model="detail">
					</div>
					@error('detail') <p class="text-danger">{{ $message }}</p> @enderror
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" wire:click="$emit('closeModal')">Close</button>
			</div>
		</div>
	</div>
</div>
@endif
@if($this->isEditOpen==1)
<div class="modal" style="display: block" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Todo</h5>
			</div>
			<div class="modal-body">
				<form wire:submit.prevent="update">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" wire:model="name">
					</div>
					@error('name') <p class="text-danger">{{ $message }}</p> @enderror
					<div class="form-group">
						<label>Detail</label>
						<input type="text" class="form-control" wire:model="detail">
					</div>
					@error('detail') <p class="text-danger">{{ $message }}</p> @enderror
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" wire:click="$emit('closeEditModal')">Close</button>
			</div>
		</div>
	</div>
</div>
@endif
<div class="container">
	<h1 class="text-center">Todo</h1>
	<div wire:poll.1s>
		<p>Current time: {{ now() }}</p>
	</div>
	<button class="btn btn-primary" wire:click="$emit('showModal')">Add</button>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>STT</th>
				<th>Name</th>
				<th>Detail</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($todos as $todo)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $todo->name }}</td>
				<td>{{ $todo->detail }}</td>
				<td>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" wire:click="edit({{ $todo->id }})" 
							class="btn btn-warning">Edit</button>
							<button type="button" class="btn btn-danger"
							wire:click="delete({{ $todo->id }})">Delete</button>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $todos->links() }}
	</div>