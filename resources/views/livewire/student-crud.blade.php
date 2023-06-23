<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Grade</th>
                <th>Department</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->grade }}</td>
                    <td>{{ $student->department }}</td>
                    <td>{{ $student->image }}</td>
                    <td>
                        <button wire:click="edit({{ $student->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $student->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
