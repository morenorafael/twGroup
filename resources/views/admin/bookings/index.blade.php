<x-app-layout>
    <!-- Page Heading -->
	@if (request()->routeIs('admin.rooms.index'))
		<h1 class="h3 mb-4 text-gray-800">{{ __('Bookigs') }}</h1>
	@endif

	<!-- Room List -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
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