@extends('employee.layout')
@section('content')
    <div style="margin: 50px 200px;" class="row">
        <div class="col-md-4">
            <div id="product-main-img">
                <div class="product-preview">
                    <img width="100%" src="{{ asset($equipment->image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="product-details">
                <h2 class="product-name">{{ $equipment->name }}</h2>


                <p>{!! $equipment->description !!}</p>





                <ul class="product-links">
                    <li>Type:</li>
                    <li><a
                            href="{{ route('show_equipment', ['id' => $equipment->type_id]) }}">{{ $equipment->type->type_name }}</a>
                    </li>

                </ul>

                <ul class="product-links">
                    <li>Share:</li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul>


            </div>
            <div class="my-4 add-to-cart">
                @if ($equipment->status == 0)
                    <a onclick="return confirm('Are you sure to borrow this equipment');" class="btn btn-danger"
                        href="{{ route('borrow_equipment', ['id' => $equipment->equipment_id]) }}"><i
                            class="fa-solid fa-address-card"></i> Borrow</a>
                @endif
            </div>
        </div>
    </div>
@endsection
