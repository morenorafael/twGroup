<x-app-layout>
    <!-- Page Heading -->
	@if (request()->routeIs('admin.rooms.index'))
		<h1 class="h3 mb-4 text-gray-800">{{ __('Rooms') }}</h1>
	@else
		<h1 class="h3 mb-4 text-gray-800">{{ __('Create Room') }}</h1>
	@endif

	<!-- Room List -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<h3 class="card-title">{{ __('Rooms') }}</h3>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="float-right">
								<a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">{{ __('Create Room') }}</a>
							</div>
						</div>
					</div>
				</div>
				
				 <div class="card-body">
					 @if (request()->routeIs('admin.rooms.index'))
						 <table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>{{ __('Name') }}</th>
									<th>{{ __('Description') }}</th>
									<th>{{ __('Actions') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($rooms as $room)
									<tr>
										<td>{{ $room->name }}</td>
										<td>{{ $room->description }}</td>
										<td>
											<a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-primary">{{ __('Show') }}</a>
											<a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary">{{ __('Edit') }}</a>
											<form action="{{ route('admin.rooms.destroy', $room) }}" method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>{{ __('No rooms found.') }}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-app-layout>