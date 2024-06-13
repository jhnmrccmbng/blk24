
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
								<h3 class="m-0">Your Cart<span class="fa fa-plus"></span></h3>
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

						<div class="container">
							<div class="row">
								<div class="col-xl-8">
									
									<form action="{{route('checkout')}}" method="POST" enctype="multipart/form-data">

										@csrf

										<span hidden="">{{$total = 0}}</span>

										@foreach($carts as $id => $product)
										<div class="card border shadow-none">
											<div class="card-body">

												<div class="d-flex align-items-start border-bottom pb-3">

													<div class="col-md-1">
															<div class="mt-2">
																<a href="{{route('deletecartItem', $product->id)}}" onclick="return confirm('Do you want to remove it?')" class="btn btn-danger btn-sm" title="Remove item">x</a>
															</div>
														</div>

													<div class="me-4 container">
														<img src="{{ url('storage/'.$product->products->product_image) }}" style="height: 160px; width: 135px">
													</div>
													<div class="flex-grow-1 align-self-center overflow-hidden">
														<div>
															<h5 class="text-truncate font-size-18"><a href="#" class="text-dark"> {{$product->products->product_name}} </a></h5>

															<p class="mb-0 mt-1 small">{{$product->products->product_slogan}}</p>
														</div>
													</div>
													<div class="flex-shrink-0 ms-2">
														<ul class="list-inline mb-0 font-size-16">
															<li class="list-inline-item">
																<a href="#" class="text-muted px-1">
																	<i class="mdi mdi-trash-can-outline"></i>
																</a>
															</li>
															<li class="list-inline-item">
																<a href="#" class="text-muted px-1">
																	<i class="mdi mdi-heart-outline"></i>
																</a>
															</li>
														</ul>
													</div>
												</div>

												<div>
													<div class="row">
														<div class="col-md-4">
															<div class="mt-3">
																<p class="text-muted mb-2">Price</p>
																<h5 class="mb-0 mt-2"><span class="text-muted me-2"></span>₱{{$product->products->product_price}}</h5>
															</div>
														</div>
														<div class="col-md-5">
															<div class="mt-3">
																<p class="text-muted mb-2">Quantity</p>
																<div class="d-inline-flex">
																	<select class="form-select form-select-sm w-xl" readonly>
																		<option value="{{$product->cart_product_qty}}" selected="">{{$product->cart_product_qty}}</option>
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																		<option value="6">6</option>
																		<option value="7">7</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="mt-3">
																<p class="text-muted mb-2">Total</p>
																<h5>₱{{$product->cart_product_qty * $product->cart_product_price}}</h5>
															</div>
														</div>
													</div>
												</div>

											</div>
										</div>
										<!-- end card -->

										<div hidden="">
											{{$itemtotal = $product->cart_product_qty * $product->cart_product_price}}
											{{ $total += $itemtotal }}

											<input type="text" name="totalorder" value="{{$total}}" hidden="">

											<input type="text" name="resto_id" value="{{$carts->first()->cart_restaurant_id}}">
										</div>

										@endforeach

										<label class="form-control">Mode of Services*: 
											@foreach($services as $id => $service)
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="orderservicetype" id="inlineRadio1" value="{{$id}}" required="">
													<label class="form-check-label" for="inlineRadio1">{{$service}}</label>
												</div>
											@endforeach
										</label>

										<label class="form-control">Mode of Payment*: 
											@foreach($payments as $id => $payment)
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="orderpaymenttype" id="inlineRadio1" value="{{$id}}" required="">
													<label class="form-check-label" for="inlineRadio1">{{$payment}}</label>
												</div>
											@endforeach
										</label><br>

										<label class="form">Leave a message (optional): </label>
											
												<div class="form-check form-check-inline col-sm-12">
													<textarea class="form-control" rows=3 name="remarks"></textarea>
												</div>
											

										<div class="row my-4">
											<div class="col-sm-6">
												<a href="{{url('/home')}}" class="btn btn-block btn-secondary">
													<i class="mdi mdi-arrow-left me-1"></i> Cancel </a>
												</div> <!-- end col -->
												<div class="col-sm-6">
													<div class="text-sm-end mt-2 mt-sm-0">
														<button type="submit" class="btn btn-success btn-block"><i class="mdi mdi-cart-outline me-1"></i> Checkout</button>
													</div>
												</div> <!-- end col -->
											</div> <!-- end row-->
										</form>
									</div>
									
									<div class="col-xl-4">
										<div class="mt-5 mt-lg-0">
											<div class="card border shadow-none">
												<div class="card-header bg-transparent border-bottom py-3 px-4">
													<h5 class="font-size-16 mb-0">---Order Summary <span class="float-end">@  {{$carts->first()->products->restaurants->restaurant_name ?? ''}}---</span></h5>
												</div>
												<div class="card-body p-4 pt-2">

													<div class="table-responsive">
														<table class="table mb-0">
															<tbody>
																<tr>
																	<td>Sub Total :</td>
																	<td class="text-end">---</td>
																</tr>
																	<!-- 	<tr>
																			<td>Discount : </td>
																			<td class="text-end"></td>
																		</tr> -->
																		<!-- <tr>
																			<td>Shipping Charge :</td>
																			<td class="text-end">$ 25</td>
																		</tr> -->
																		<!-- <tr>
																			<td>Estimated Tax : </td>
																			<td class="text-end">$ 18.20</td>
																		</tr> -->
																		<tr class="bg-light">
																			<th>Total :</th>
																			<td class="text-end">
																				<span class="fw-bold">
																					<b>₱{{$total}}</b>
																				</span>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<!-- end table-responsive -->
														</div>
													</div>
												</div>
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