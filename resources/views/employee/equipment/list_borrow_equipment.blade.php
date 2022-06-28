@extends('employee.layout')
@section('content')
    @if (session('message'))
        <span class="notify text-center">{{ session('message') }}</span>
    @endif
    <h3 class="text-center text-danger">List Borrow Equipment </h3>
    <table class="text-center table table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Equipment Name</th>
                <th class="text-center">Image</th>
                <th class="text-center">Borrow_date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Cancel</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($borrow as $borrow_value)
                <?php $i++;
                
                ?>

                <tr>
                    <td scope="row">{{ $i }}</td>
                    <td>{{ $borrow_value->equipment->name }}</td>


                    <td><img width="150" src="{{ asset($borrow_value->equipment->image) }}" alt=""></td>
                    <td>{{ $borrow_value->borrow_date }}</td>

                    <td>
                        @if ($borrow_value->status == 0)
                            <span class="btn btn-warning">Waiting</span>
                        @elseif ($borrow_value->status == 1)
                            <span class="btn btn-success">Using</span>
                        @elseif ($borrow_value->status == 2)
                            <span class="btn btn-danger">Denied</span>
                        @else
                            <span class="btn btn-primary">Paid</span>
                        @endif
                    </td>
                    <td>
                        @if ($borrow_value->status == 0)
                            <a onclick="return confirm('Are you sure cancel this request?');"
                                style="color:red; font-size: 30px;"
                                href="{{ route('cancel_borrow', ['id' => $borrow_value->borrow_id]) }}"><i
                                    class="fa-solid fa-circle-xmark"></i></a>
                        @else
                        @endif

                    </td>


                </tr>
            @endforeach


        </tbody>
    </table>
@endsection
