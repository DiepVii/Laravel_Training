@extends('admin.layout')
@section('content')
    @if (session('message'))
        <span class="notify text-center">{{ session('message') }}</span>
    @endif
    <h3 class="text-center text-danger">List Equipment</h3>
    <table class=" text-center table table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Equipment Name</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Type</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($equipment as $equipment_value)
                <?php $i++;
                
                ?>

                <tr>
                    <td scope="row">{{ $i }}</td>
                    <td>{{ $equipment_value->name }}</td>

                    <td width="400" class="description">{!! $equipment_value->description !!}</td>
                    <td><img width="150" src="{{ asset($equipment_value->image) }}" alt=""></td>


                    <td>
                        @if ($equipment_value->status == 0)
                            <span class="btn btn-success">Enable</span>
                        @elseif ($equipment_value->status == 1)
                            <span class="btn btn-secondary">Disable</span>
                        @elseif ($equipment_value->status == 2)
                            <span class="btn btn-warning">Wait</span>
                        @else
                            <span class="btn btn-danger">Damaged</span>
                        @endif
                    </td>
                    <td>{!! $equipment_value->type->type_name !!}</td>
                    <td>
                        <a style="font-size: 30px;"
                            href="{{ route('edit-equipment', ['id' => $equipment_value->equipment_id]) }}"><i
                                class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Are you sure to delete this equipment');"
                            style="color:red; font-size: 30px;"
                            href="{{ route('delete-equipment', ['id' => $equipment_value->equipment_id]) }}"><i
                                class="fas fa-trash"></i></a>
                    </td>

                </tr>
            @endforeach
            <tr>
                <td colspan="7">
                    <div class="d-flex justify-content-center">
                        {!! $equipment->links() !!}
                    </div>
                </td>
            </tr>
        </tbody>

    </table>

    <script>
        $(document).ready(function() {
            $('#search2').keyup(function() {
                $value = $(this).val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('equipment_search') }}",
                    data: {
                        'search': $value,
                        '_token': '{{ csrf_token() }}'
                    },

                    success: function(type) {
                        console.log(type.data)

                        $('tbody').html(type);
                    }
                });
            })
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
        })
    </script>
@endsection
