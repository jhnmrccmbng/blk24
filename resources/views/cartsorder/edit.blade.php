@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="" id="signinEvents1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header badge-primary">
                <h5 class="modal-title" class="float-sm-left" id="">View Order</h5>

            </div>
            <div class="modal-body-wrapper">
                <div class="modal-body">

                   <!--  <form action="{{route('carts.store')}}" method="post" enctype="multipart/form-data">
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
            </form> -->

            <div class="page-content container">
                <div class="page-header text-blue-d1">
                    <h5 class="page-title text-secondary-d1">
                        Receipt
                        <small class="page-info">
                            <i class="fa fa-angle-double-right text-80"></i>
                            ID Number: <text id="receiptnumber">{{$cartsorder->co_receiptnumber}}</text>

                        </small> <br>

                        @if($cartsorder->co_paymonggo_id != null)
                        <small class="page-info">
                            <i class="fa fa-angle-double-right text-80"></i>
                            Online Payment Number: <text id="receiptnumber">{{$cartsorder->co_paymonggo_id}}</text>

                        </small>
                        @endif
                    </h5>

      <!--   <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
            </div>
        </div> -->
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <!-- .row -->
                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle"><text id="name">{{$cartsorder->user->name}}</text></span>

                            <span class="text-600 text-110 text-black align-middle float-right"><text id="name">{{$cartsorder->restaurant->restaurant_name}}</text></span>
                        </div>

                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Status:</span>
                            <span class="text-600 text-110 text-red align-middle"><text id="status"><a href="#"> {{$cartsorder->status->status_name}}</a></text></span>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">

                    <div class="row text-600 text-black bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Description</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                        <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                        <div class="col-2">Amount</div>
                    </div>

                    <div class="text-95 text-secondary-d3">

                        @foreach($cartsorder->placed_at_carts as $id => $item)

                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">{{$id + 1}}</div>
                            <div class="col-9 col-sm-5">{{$item->products->product_name}}</div>
                            <div class="d-none d-sm-block col-2">{{$item->cart_product_qty}}</div>
                            <div class="d-none d-sm-block col-2 text-95">₱{{$item->products->product_price}}</div>
                            <div class="col-2 text-secondary-d2">{{$item->cart_product_qty * $item->products->product_price}}</div>
                        </div>

                        @endforeach
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        -->

        <div class="row mt-3">
            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0 small">
                <i>{{$cartsorder->co_remarks != null ? 'Message: '.$cartsorder->co_remarks : '---'}}</i>
            </div>

            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                    <div class="col-7 text-right">
                        <b>Total Amount:</b>
                    </div>
                    <div class="col-5">
                        <span class="text-150 text-success-d3 opacity-2">₱{{$cartsorder->co_totalpayment}}</span>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <div>
            <span class="text-secondary-d1 text-105">Mode of Payment: <b>{{$cartsorder->paymentmode->payment_name}}</b></span> |
            <span class="text-secondary-d1 text-105">Service: <b>{{$cartsorder->service->service_name}}</b></span>
            <a href="{{route('cartsorder.index')}}" class="btn btn-danger btn-bold px-4 float-right mt-3 mt-lg-0">Close</a>
        </div>
    </div>
</div>
</div>
</div>
</div> <br>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Order Status Timeline</h6>
                    <div id="content">
                        <ul class="timeline">

                            @foreach($cartsorder->status_actions as $id => $orderStatus)

                                <li class="event" data-date="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderStatus->created_at)->format('F j, Y | G:i:A') }}">
                                    <h3>{{$orderStatus->status->status_name}}</h3>
                                    <p>{{$orderStatus->sa_remarks}}</p>
                                    <p><small class="">{{$orderStatus->user->name}}</small></p>
                                </li>

                            @endforeach


                           <!--  <li class="event" data-date="2:30 - 4:00pm">
                                <h3>Opening Ceremony</h3>
                                <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP &amp; Busta Rhymes as an opening show.</p>
                            </li>
                            <li class="event" data-date="5:00 - 8:00pm">
                                <h3>Main Event</h3>
                                <p>This is where it all goes down. You will compete head to head with your friends and rivals. Get ready!</p>
                            </li>
                            <li class="event" data-date="8:30 - 9:30pm">
                                <h3>Closing Ceremony</h3>
                                <p>See how is the victor and who are the losers. The big stage is where the winners bask in their own glory.</p>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>
</div>

</div>
</div>
</div>


<style type="text/css">

    .timeline {
        border-left: 3px solid #727cf5;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        background: rgba(114, 124, 245, 0.09);
        margin: 0 auto;
        letter-spacing: 0.2px;
        position: relative;
        line-height: 1.4em;
        font-size: 1.03em;
        padding: 50px;
        list-style: none;
        text-align: left;
        max-width: 40%;
    }

    @media (max-width: 767px) {
        .timeline {
            max-width: 98%;
            padding: 25px;
        }
    }

    .timeline h1 {
        font-weight: 300;
        font-size: 1.4em;
    }

    .timeline h2,
    .timeline h3 {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .timeline .event {
        border-bottom: 1px dashed #e8ebf1;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline .event {
            padding-top: 30px;
        }
    }

    .timeline .event:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline .event:before,
    .timeline .event:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .event:before {
        left: -240px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline .event:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline .event:after {
        -webkit-box-shadow: 0 0 0 3px #727cf5;
        box-shadow: 0 0 0 3px #727cf5;
        left: -55.8px;
        background: #fff;
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 5px;
    }

    @media (max-width: 767px) {
        .timeline .event:after {
            left: -31.8px;
        }
    }

    .rtl .timeline {
        border-left: 0;
        text-align: right;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
        border-right: 3px solid #727cf5;
    }

    .rtl .timeline .event::before {
        left: 0;
        right: -170px;
    }

    .rtl .timeline .event::after {
        left: 0;
        right: -55.8px;
    }
</style>
@endsection