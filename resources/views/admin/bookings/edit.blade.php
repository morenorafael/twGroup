<x-app-layout>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Booking') }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Update Room') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label>{{ __('Room') }}: {{ $booking->room->name }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Customer Name') }}: {{ $booking->user->name }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Reserved for') }}: {{ $booking->reserved_for }}</label>
                        </div>
                        <div class="form-group">
                            <label for="description">Status</label>
                            
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $booking->status === 1 ? 'selected' : '' }}>{{ __('Pendig') }}</option>
                                <option value="2" {{ $booking->status === 2 ? 'selected' : '' }}>{{ __('Approve') }}</option>
                                <option value="3" {{ $booking->status === 3 ? 'selected' : '' }}>{{ __('Reject') }}</option>
                            </select>

                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="update-room-button">{{ __('Update Room') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>