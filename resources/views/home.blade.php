@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif  

            <div class="content-header">
                <div class="container-fluid">

                    <div class="col-md-12" id="verifyuser">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                            <button class="close" onclick="document.getElementById('verifyuser').style.display='none'">x</button>
                        </div>
                        @endif
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">{{ __('Dashboard') }} 
                                  @can('only-customer-can-access')
                                    <a href="{{route('cartsorder.index')}}" title="View Order">
                                    <span class="ion-ios-list"></span><span class="badge badge-default">{{$cartsorders}}</span></a>
                                  @endcan

                                   @can('only-admin-and-cashier-can-access')
                                    <a href="{{route('inventory.index')}}" title="View Inventory">
                                    <span class="ion-ios-list"></span><span class="badge badge-default">{{$items}}</span></a>
                                  @endcan
                                </h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Home') }}</a></li>
                                    <li class="breadcrumb-item active">{{ Auth::user()->role_users->roles->role_name }} Account</li>

                                    @can('only-customer-can-access')
                                    <li class="breadcrumb-item active"><a href="{{route('carts.index')}}" title="View Cart"><span class="ion-ios-cart-outline"></span><span class="badge badge-default">{{$carts}}</span></a></li>
                                    @endcan
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @can('only-admin-and-cashier-can-access')
                    <section class="content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-3 col-6">

                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{$cartsorders}}</h3>
                                            <p>New Orders</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="{{route('cartsorder.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">

                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{\App\Product::count()}}</h3>
                                            <p>Products</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pricetags"></i>
                                        </div>
                                        <a href="{{route('products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">

                                    <div class="small-box bg-secondary">
                                        <div class="inner">
                                            <h3>{{$users}}</h3>
                                            <p>User Management</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">

                                    <div class="small-box bg-default">
                                        <div class="inner">
                                            <h3>{{$restaurants->count()}}</h3>
                                            <p>Restaurant Branch</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-android-bookmark"></i>
                                        </div>
                                        <a href="{{route('restaurants.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <div class="container-fluid">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                  <th scope="col">Status </th>
                                  <th scope="col">No. of Orders</th>
                              </tr>
                          </thead>
                          <tbody>
                           @foreach($mappedcollection as $status => $arrayStatus)
                           <tr>
                             <td><a href="{{route('view_order_status', ['id' => encrypt($status)])}}">{{$status}}</a></td>
                             <td>{{$arrayStatus}}</td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>

             <div class="card-body">
              <!-- chart here -->

              <div class="item active">
                {!! $chartjs->render() !!}
            </div> <br>

            <hr>
            <form class="row g-3" method="GET" action="{{route('home')}}">
                @csrf
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Star Date:</label>
                        <input type="date" class="form-control" name="startdate" value="{{\Request::get('startdate')}}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">End Date:</label>
                         <input type="date" class="form-control" name="enddate" value="{{\Request::get('enddate')}}">
                  </div>
                  <div class="col-md-4">
                    <label for="inputZip" class="form-label"> </label>
                    <button type="submit" class="form-control btn btn-outline-danger">Generate</button>
                </div>
            </form>

            @if(\Request::get('startdate') AND \Request::get('enddate'))
                 <div class="item active">
                    <br>
                    {!! $chartjs1->render() !!}
                </div> <br>
            @endif
    </div>

</div>

@endcan

@can('only-customer-can-access')

<div class="card-deck">
    @foreach($restaurants as $id => $resto)
    <div class="card">
        <a href="{{route('view_restaurant', ['id' => encrypt($resto->id)])}}"><img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMfPJzlHg12Pb0nJAFDmapvFeV6GIgt5UwsUpHwQ50YnMtf2b9uEjg9GqHLmw5Qargnug&usqp=CAU" alt="Card image cap"></a>
        <div class="card-body">
          <h5 class="card-title" style="color: #FC6C85">{{$resto->restaurant_name}}</h5>
          <p class="card-text" style="color: #FC6C85"><i><small>{{$resto->restaurant_address}} | {{$resto->restaurant_phone}}</small></i></p>
      </div>
      <div class="card-footer">
          <small class="text-muted">{{$resto->restaurant_url}}</small>
      </div>
  </div>
  @endforeach

</div>

@endcan

</div>
</div>
</div>
</div>
</div>
@endsection

