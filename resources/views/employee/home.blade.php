@extends('employee.layout')
@section('content')
    <h3 class="h3-equipment text-center">All Equipment</h3>
    <div class="col-md-12">

        <div class="row">
            @foreach ($equipment as $equipment_value)
                <div class="mb-5 col-sm-3">
                    <div class="product">
                        <div class="product-img">
                            <img width="150" src="{{ asset($equipment_value->image) }}" alt="">

                        </div>
                        <div class="product-body">
                            <p class="product-category">{{ $equipment_value->type->type_name }}</p>
                            <h3 class="product-name"><a href="#">{{ $equipment_value->name }}</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>

                        </div>
                        <div class="add-to-cart">
                            <a class="btn btn-danger"
                                href="{{ route('detail_equipment', ['id' => $equipment_value->equipment_id]) }}"><i
                                    class="fa-solid fa-cube"></i> View Detail</a>

                        </div>
                    </div>
                </div>
            @endforeach



        </div>
        <div class="mt-5 d-flex justify-content-center">
            {!! $equipment->links() !!}
        </div>

    </div>
@endsection
