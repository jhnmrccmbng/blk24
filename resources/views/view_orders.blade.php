@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <br>
               <div class="col-md-12" id="verifyuser">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                    <button class="close" onclick="document.getElementById('verifyuser').style.display='none'">x</button>
                </div>
                @endif
            </div>

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">{{$viewResto->restaurant_name}} <span class="fa fa-plus"></span></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                                <li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ Auth::user()->role_users->roles->role_name }} Account</li>

                                @can('only-customer-can-access')
                                    <li class="breadcrumb-item active"><a href="{{route('carts.index')}}" title="View Cart"><span class="ion-ios-cart-outline"></span><span class="badge badge-default">{{$carts->count()}}</span></a></li>
                                @endcan
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">

                <div class="container mt-5 mb-5">
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-10">

                            @foreach($viewResto->products as $id => $product)
                            <div class="row p-2 bg-white border rounded">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{ url('storage/'.$product->product_image) }}" style=""></div>
                                <div class="col-md-6 mt-1">
                                    <br><h3>{{$product->product_name}}</h3>
                                    <p class="text-justify mb-0 mt-1 small">{{$product->product_slogan}}</p>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">₱ {{$product->product_price}}</h4><span class="strike-text"></span>
                                    </div>
                                    <h6 class="text-success">---</h6>

                                    <div class="d-flex flex-column mt-4">

                                        <button class="btn btn-primary btn-sm" type="button">Details</button>

                                        <a href="javascript:void(0)" type="button" class="btn btn-outline-primary btn-sm mt-2 openModal 

                                        

                                        " title="..." data-url="{{route('viewproduct', $product->id)}}" >Add to cart</a>
                                        
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>

                        <!-- <text class="text text-danger"> <br>
                            <i>
                                @if($carts->count() == 0)

                                @elseif($carts->count() >= 0)

                                @else

                                  *Adding item in your cart is disabled, you have item listed in another branch. Please proceed to checkout first. Thank you!*

                                @endif
                            </i>
                        </text> -->
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<style type="text/css">
    body{}.ratings i{font-size: 16px;color: red}.strike-text{color: red;text-decoration: line-through}.product-image{width: 100%}.dot{height: 7px;width: 7px;margin-left: 6px;margin-right: 6px;margin-top: 3px;background-color: blue;border-radius: 50%;display: inline-block}.spec-1{color: #938787;font-size: 15px}h5{font-weight: 400}.para{font-size: 16px}
</style>

<script type="text/javascript">
    $(document).ready(function () {

        /* When click show user */
        $('body').on('click', '.openModal', function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {

                $('#signinEvents1').modal('show');
                $('#product_name').text(data.product_name);
                $('#productID').val(data.id);
                $('#product_price').val(data.product_price);
                $('#resto_id').val(data.restaurant_id);
                // $('img#modal-barcode-img').attr('src', 'data:image/png;base64, '+ data.barcode_img_base64);
            })
        });

        $('#confirmclose').click(function() {
            $('#signinEvents1').modal('hide');
        });

        const ogInput = document.getElementById("order_qty")
        const mirrorInput = document.getElementById("order_total")
        const prod_price = document.getElementById("product_price")

        ogInput.addEventListener("input", () => {
            mirrorInput.value  = ogInput.value * prod_price.value;
        })
    });


</script>

<!-- Modal -->
<div class="modal fade" id="signinEvents1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header badge-primary">
                <h5 class="modal-title" class="float-sm-left" id="product_name"></h5>

            </div>
            <div class="modal-body-wrapper">
                <div class="modal-body">

                    <form action="{{route('carts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="text" class="form-control" name="order_product" value="" id="productID" hidden="">

                        <input type="text" class="form-control" name="user_id" value="{{Auth::user()->id}}" hidden="">

                        <input type="text" class="form-control" name="restaurant_id" id="resto_id" value="" hidden="">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="number" class="form-control" name="order_quantity" aria-describedby="emailHelp" id="order_qty">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Price</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest peso)" id="product_price" name="product_price" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Total</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="order_total" readonly>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" id="confirmclose">Close</button>
                <button type="submit" class="btn btn-success">Confirm</button>
            </form>

        </div>
    </div>

</div>
</div>
</div>
@endsection