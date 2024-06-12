@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        	 <div class="col-md-12" id="verifyuser">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                    <button class="close" onclick="document.getElementById('verifyuser').style.display='none'">x</button>
                </div>
                @endif
            </div>
            <div class="card">
              
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">{{ __('Products') }} <span class="fa fa-plus"><a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#addproduct">Add product</a></span></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ Auth::user()->role_users->roles->role_name }} Account</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <section class="content">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slogan</th>
                                <th>Branch</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                           @foreach($products as $id => $product)
	                            <tr>
	                                <td>{{$product->id}}</td>
	                                <td><img src="{{ url('storage/'.$product->product_image) }}" style="height: 80px; width: 90px" class="form-control @error('branch_image') is-invalid @enderror image-rounded" alt=""></td>
	                                <td>{{$product->product_name}}</td>
	                                <td>{{$product->product_slogan}}</td>
	                                <td>{{$product->restaurants->restaurant_name}}</td>
	                                <td>{{'₱ '.$product->product_price}}</td>
	                                <td>{{$product->product_quantity}}</td>
	                                <td><i>{{'₱ '.number_format($product->product_price * $product->product_quantity)}} </i></td>
	                                <td>
	                                    <div class="btn-group" role="group" aria-label="Basic example">
	                                        <a href="{{route('products.edit', encrypt($product->id))}}" class="btn btn-success">Edit</a>
	                                        <form action="{{route('products.destroy', $product->id)}}" method="POST" onclick="return confirm('Do you want to delete it?')">
	                                            <input name="_method" type="hidden" value="DELETE">
	                                            {{ csrf_field() }}
	                                            <button type="submit" class="btn btn-danger">Delete</button>
	                                        </form>
	                                    </div>
	                                </td>
	                            </tr>
                           @endforeach
                        </tbody>
                    </table>

                </section>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('Select Branch/Restaurant') }}</label>

            <div class="col-md-6">

                <select class="form-control @error('roles') is-invalid @enderror" name="category" required="">
                    <option value="">--- Please select---</option>
                   @foreach($restaurants as $id => $restaurant)
                   	<option value="{{$id}}">{{$restaurant}}</option>
                   @endforeach
                </select>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <hr>

        <div class="form-group row">
            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="product_name" autofocus>

                @error('product_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

          <div class="form-group row">
            <label for="product_slogan" class="col-md-4 col-form-label text-md-right">{{ __('Slogan') }}</label>

            <div class="col-md-6">
                <input id="product_slogan" type="text" class="form-control @error('product_slogan') is-invalid @enderror" name="product_slogan" value="{{ old('product_slogan') }}" required autocomplete="product_slogan" autofocus>

                @error('product_slogan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

           <div class="form-group row">
            <label for="product_price" class="col-md-4 col-form-label text-md-right">{{ __('Price (₱)') }}</label>

            <div class="col-md-6">
                <input id="product_price" type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ old('product_price') }}" required autocomplete="product_price" autofocus>

                @error('product_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


 <div class="form-group row">
            <label for="product_quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

            <div class="col-md-6">
                <input id="product_quantity" type="number" class="form-control @error('product_quantity') is-invalid @enderror" name="product_quantity" value="{{ old('product_quantity') }}" required autocomplete="product_quantity" autofocus>

                @error('product_quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product Image') }}</label>

            <div class="col-md-6">
                <input id="product_image" type="file" class="form-control @error('product_image') is-invalid @enderror" name="product_image" value="{{ old('product_image') }}" required autocomplete="product_image" autofocus accept="image/png, image/jpeg">

                @error('product_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
    </form>

</div>

</div>
</div>
</div>

@endsection