<x-app-layout>
    <!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">{{ __('Bookigs') }}</h1>

	<!-- Room List -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<h3 class="card-title">{{ __('Bookigs') }}</h3>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="float-right">
								<a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">{{ __('Create Bookig') }}</a>
							</div>
						</div>
					</div>
				</div>

				 <div class="card-body">
					 @if (request()->routeIs('admin.bookings.index'))
						 <table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>{{ __('Customer Name') }}</th>
									<th>{{ __('Room') }}</th>
                                    <th>{{ __('Reserved for') }}</th>
									<th>{{ __('Status') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($bookings as $booking)
									<tr>
										<td>{{ $booking->user->name }}</td>
										<td>{{ $booking->room->name }}</td>
                                        <td>{{ $booking->reserved_for }}</td>
										<td>{{ $booking->status == 1 ? __('Pendig') : __('Approve') }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>{{ __('No bookings found.') }}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</x-app-layout>