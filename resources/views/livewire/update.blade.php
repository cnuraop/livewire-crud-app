<div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            <input type="hidden" wire:model="id">
    
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" wire:model="name" class="form-control">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" wire:model="grade" class="form-control">
                @error('grade') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" wire:model="department" class="form-control">
                @error('department') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <div class="form-group">
                <label for="image">Image</label>
                @if ($image)
                    <img src="{{ Storage::url($image) }}" class="img-thumbnail" width="200" alt="Student Image">
                @else
                    <img src="{{ asset('path/to/default/image') }}" class="img-thumbnail" width="200" alt="Student Image">
                @endif
                <input
                    type="file"
                    x-data
                    x-ref="image"
                    x-init="
                        FilePond.create($refs.image, {
                            allowImagePreview: true,
                            allowFileTypeValidation: true,
                            acceptedFileTypes: ['image/*'],
                            maxFileSize: '4MB',
                        });
                    "
                    wire:model="image"
                    class="form-control"
                >
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <button type="submit" class="btn btn-primary">Update</button>

</form>
    </div>