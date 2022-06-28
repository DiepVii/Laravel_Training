@extends('admin.layout')
@section('content')
    <h3 class="text-center text-danger">Add Equipment</h3>
    <form enctype="multipart/form-data" method="post" action="{{ route('save-equipment') }}" class="form-css">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Equipment Name</label>
            <input type="text" name="equipment_name" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter equipment Name" required>
            @if ($errors->has('equipment_name'))
                <p class="text-danger">{{ $errors->first('equipment_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea id="summary-ckeditor1" class="form-control" name="equipment_desc" cols="30" rows="5" required></textarea>
        </div>
        @if ($errors->has('equipment_desc'))
            <p class="text-danger">{{ $errors->first('equipment_desc') }}</p>
        @endif
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input id="fileinput" required type="file" name="equipment_image" class="form-control" accept="image/*">
            <img src="" id="image" alt="">
        </div>
        @if ($errors->has('equipment_image'))
            <p class="text-danger">{{ $errors->first('equipment_image') }}</p>
        @endif
        <div class="form-group">
            <label for="exampleInputPassword1">Type</label>
            <select name="type_id" id="" class="form-control">
                @foreach ($type as $type_value)
                    <option value="{{ $type_value->type_id }}">{{ $type_value->type_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add equipment</button>
    </form>
@endsection
