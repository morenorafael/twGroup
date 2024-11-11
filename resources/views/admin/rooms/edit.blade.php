<x-app-layout>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Room') }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Update Room') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $room->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="update-room-button">{{ __('Update Room') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
