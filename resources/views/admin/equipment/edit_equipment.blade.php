@extends('admin.layout')
@section('content')
    <h3 class="text-center text-danger">Edit Equipment</h3>
    <form enctype="multipart/form-data" method="post"
        action="{{ route('update-equipment', ['id' => $equipment->equipment_id]) }}" class="form-css">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Equipment Name</label>
            {{-- <input type="hidden" name="id" value="{{ $equipment->equipment_id }}"> --}}
            <input type="text" name="equipment_name" value="{{ $equipment->name }}" class="form-control"
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter equipment Name" required>
            @if ($errors->has('equipment_name'))
                <p class="text-danger">{{ $errors->first('equipment_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea id="summary-ckeditor" class="form-control" name="equipment_desc" cols="30" rows="5" required>{{ $equipment->description }}</textarea>
        </div>
        @if ($errors->has('equipment_desc'))
            <p class="text-danger">{{ $errors->first('equipment_desc') }}</p>
        @endif
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input id="fileinput" type="file" name="equipment_image" class="form-control" accept="image/*">
            <img width="150" src="{{ asset($equipment->image) }}" id="image" alt="">
        </div>
        @if ($errors->has('equipment_image'))
            <p class="text-danger">{{ $errors->first('equipment_image') }}</p>
        @endif
        {{-- <div class="form-group">
            <label for="exampleInputPassword1">Status</label>
            <select name="type_id" id="" class="form-control">

                <option value="{{ $equipment->status }}">{{ $equipment->type->type_name }}</option>
                <option value="3">Damaged</option>
            </select>
        </div> --}}
        <div class="form-group">
            <label for="exampleInputPassword1">Type</label>
            <select name="type_id" id="" class="form-control">
                @foreach ($type as $type_value)
                    @if ($type_value->type_id == $equipment->type_id)
                        <option selected value="{{ $type_value->type_id }}">{{ $type_value->type_name }}</option>
                    @else
                        <option value="{{ $type_value->type_id }}">{{ $type_value->type_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Edit equipment</button>
    </form>
@endsection
