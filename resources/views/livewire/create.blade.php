<div>

    <form wire:submit.prevent="store" enctype="multipart/form-data">
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

        {{-- <div class="form-group">
            <label for="image">Image</label>
            <input type="file" wire:model="image" class="form-control">
            @error('image') <span class="error">{{ $message }}</span> @enderror
        </div> --}}


        <div class="form-group">
            <label for="image">Image</label>
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

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
