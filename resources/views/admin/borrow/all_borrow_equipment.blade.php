@extends('admin.layout')
@section('content')
    @if (session('message'))
        <span class="notify text-center">{{ session('message') }}</span>
    @endif

    <form action="{{ route('borrow_by_user') }}" method="POST">
        @csrf
        <h3 class=" mr-5 text-right text-danger">Filter By User</h3>
        <div class="d-flex justify-content-end align-item-center mr-5" style="">
            <select class="mr-3" style="width:200px" name="filter_user" id="">
                <option value="all">All User</option>
                @foreach ($employee as $employee_value)
                    <option value="{{ $employee_value->id }}">{{ $employee_value->name }}</option>
                @endforeach


            </select>
            <button type="submit" class="btn btn-primary">Find</button>
        </div>

    </form>
    <h2 class="text-center text-danger">List Borrow Equipment</h2>
    <table class=" text-center table table-hover">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Equipment Name</th>

                <th scope="col">Image</th>
                <th scope="col">Borrow_date</th>
                <th scope="col">Pay_date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($borrow as $borrow_value)
                <?php $i++;
                
                ?>

                <tr>
                    <td scope="row">{{ $i }}</td>
                    <td>{{ $borrow_value->user->name }}</td>
                    <td>{{ $borrow_value->equipment->name }}</td>


                    <td><img width="150" src="{{ asset($borrow_value->equipment->image) }}" alt=""></td>

                    <td>{{ $borrow_value->borrow_date }}</td>
                    <td>{{ $borrow_value->pay_date }}</td>
                    <td>
                        @if ($borrow_value->status == 0)
                            <span class="btn btn-warning">Waiting</span>
                        @elseif ($borrow_value->status == 1)
                            <span class="btn btn-success">Accepted</span>
                        @elseif ($borrow_value->status == 2)
                            <span class="btn btn-danger">
                                Denied</span>
                        @else
                            <span class="btn btn-primary">Paid</span>
                        @endif
                    </td>

                    <td>
                        @if ($borrow_value->status == 0)
                            <a onclick="return confirm('Are you sure to accept this request?');"
                                style="color:green; font-size: 30px;"
                                href="{{ route('accept-borrow', ['id' => $borrow_value->borrow_id]) }}"><i
                                    class="fa-solid fa-check"></i></a>
                            <a onclick="return confirm('Are you sure to reject this request');"
                                style="color:red; font-size: 30px;"
                                href="{{ route('reject-borrow', ['id' => $borrow_value->borrow_id]) }}"><i
                                    class="fa-solid fa-ban"></i></a>
                        @elseif ($borrow_value->status == 1)
                            <a onclick="return confirm('Are you sure this equipment has been returned');"
                                style="color:green; font-size: 30px;"
                                href="{{ route('give_back_equipment', ['id' => $borrow_value->borrow_id]) }}"><i
                                    class="fa-solid fa-hand-holding-hand"></i></a>
                        @else
                            <span>No action</span>
                        @endif

                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $borrow->links() !!}
    </div>
@endsection
