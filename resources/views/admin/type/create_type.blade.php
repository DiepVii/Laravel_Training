@extends('admin.layout')
@section('content')
    <h3 class="text-center text-danger">Add Type</h3>
    <form method="post" action="{{ route('save-type') }}" class="form-css">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Type Name</label>
            <input type="text" name="type_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter Type Name" required>
            @if ($errors->has('type_name'))
                <p class="text-danger">{{ $errors->first('type_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea id="summary-ckeditor2" class="form-control" name="type_desc" cols="30" rows="5" required></textarea>
        </div>
        @if ($errors->has('type_desc'))
            <p class="text-danger">{{ $errors->first('type_desc') }}</p>
        @endif

        <button type="submit" class="btn btn-primary">Add Type</button>
    </form>
@endsection
