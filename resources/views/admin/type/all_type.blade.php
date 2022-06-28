@extends('admin.layout')
@section('content')
    @if (session('message'))
        <span class="notify text-center">{{ session('message') }}</span>
    @endif
    <h3 class="text-center text-danger">List Type</h3>
    <table class="text-center table table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Type Name</th>
                <th scope="col">Description</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($type as $type_value)
                <?php $i++; ?>

                <tr>
                    <td scope="row">{{ $i }}</td>
                    <td>{{ $type_value->type_name }}</td>
                    <td width="400">{!! $type_value->description !!}</td>
                    <td>
                        <a style="font-size: 30px;" href="{{ route('edit-type', ['id' => $type_value->type_id]) }}"><i
                                class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Deleting this type will delete equipments of this type?');"
                            style="color:red; font-size: 30px;"
                            href="{{ route('delete-type', ['id' => $type_value->type_id]) }}"><i
                                class="fas fa-trash"></i></a>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";
        $('#search2').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection
