<x-app-layout>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create booking') }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Create booking') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="room">{{ __('Rooms') }}</label>
                            <select name="room_id" id="room" class="form-control">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="reserved_for">{{ __('Reserved for') }}</label>
                            <input type="datetime-local" class="form-control" id="reserved_for" name="reserved_for">
                            @error('reserved_for')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="create-room-button">{{ __('Create booking') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
