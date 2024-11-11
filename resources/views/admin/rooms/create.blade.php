<x-app-layout>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Room') }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Create Room') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="create-room-button">{{ __('Create Room') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
