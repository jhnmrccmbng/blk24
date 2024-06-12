
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
								<h3 class="m-0">
									@can('only-admin-and-cashier-can-access')
									<th>New Orders</th>
									@endcan

									@can('only-customer-can-access')
									View Orders
									@endcan
									<span class="fa fa-plus"></span></h3>
								</div>
								<div class="col-sm-6">
									<ol class="breadcrumb float-sm-right">

										<li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('Home') }}</a></li>
										<li class="breadcrumb-item active">{{ Auth::user()->role_users->roles->role_name }} Account</li>

										@can('only-customer-can-access')
										<li class="breadcrumb-item active"><a href="{{route('carts.index')}}" title="View Cart"><span class="ion-ios-cart-outline"></span><span class="badge badge-default">{{$carts}}</span></a></li>
										@endcan
									</ol>
								</div>
							</div>

							<div class="container">
								<div class="row">
									<div class="col-xl-12">

										<table id="myTable" class="table table-hover table-condensed">
											<thead>
												<tr>
													<th>Receipt No.</th>
													<th>Date of Order Placed</th>

													@can('only-customer-can-access')
														<th>Status</th>
													@endcan

													@can('only-admin-and-cashier-can-access')
														<th>Action</th>
													@endcan

												</tr>
											</thead>
											<tbody>
												@foreach($orders as $id => $order)
													<tr>
														<td><a href="{{route('cartsorder.edit', $order->id)}}" class="openModal" data-url="{{route('cartsorder.show', $order->id)}}">{{$order->co_receiptnumber}}</a>
															<br>
															<span class="small" title="Online Transaction ID">{{$order->co_paymonggo_id != null ? $order->co_paymonggo_id : ''}}</span>
														</td>
														<td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('F j, Y | g:i:a')}}</td>

														@can('only-customer-can-access')
															<td>{{$order->status->status_name}}</td>
														@endcan

														@can('only-admin-and-cashier-can-access')
														<td>
															<div class="btn-group" role="group" aria-label="Button group with nested dropdown">

																@foreach($statuses as $id => $status)
																	
																	  <a href="{{route('change_status', ['orderID' => $order->id, 'statusID' => $id])}}" onclick="return confirm('You wanna update status to {{$status}}?')" type="button" class="{{$id == $order->co_status_id ? 'disabled btn btn-outline-danger' : ''}} btn btn-outline-primary {{$id == $order->co_status_id ? 'active' : ''}}">{{$status}}</a>

																@endforeach

															</div>
														</td>
														@endcan

													</tr>
												@endforeach
											</tbody>
										</table>

									</div>
								</div>
								<!-- end row -->
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
		@endsection