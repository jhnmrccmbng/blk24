@extends('layouts.app')

@section('content')

<div class="" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

 <div class="col-md-12" id="verifyuser">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                    <button class="close" onclick="document.getElementById('verifyuser').style.display='none'">x</button>
                </div>
                @endif
            </div>
    <form method="POST" action="{{route('products.update', $item->id)}}" enctype="multipart/form-data">
        @csrf

        {{ method_field('PATCH') }}
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('Select Branch/Restaurant') }}</label>

            <div class="col-md-6">

                <select class="form-control @error('roles') is-invalid @enderror" name="category" required="">
                    <option value="{{$item->restaurants->id}}">{{$item->restaurants->restaurant_name}}</option>
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
                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{$item->product_name}}" required autocomplete="product_name" autofocus>

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
                <input id="product_slogan" type="text" class="form-control @error('product_slogan') is-invalid @enderror" name="product_slogan" value="{{$item->product_slogan}}" required autocomplete="product_slogan" autofocus>

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
                <input id="product_price" type="number" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{$item->product_price}}" required autocomplete="product_price" autofocus>

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
                <input id="product_quantity" type="number" class="form-control @error('product_quantity') is-invalid @enderror" name="product_quantity" value="{{$item->product_quantity}}" required autocomplete="product_quantity" autofocus>

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
                <input id="product_image" type="file" class="form-control @error('product_image') is-invalid @enderror" name="product_image" value="" autocomplete="product_image" autofocus accept="image/png, image/jpeg">

                @error('product_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

          <div class="form-group row">
            <label for="product_image" class="col-md-4 col-form-label text-md-right"></label>

            <div class="col-md-6">
               <img src="{{ url('storage/'.$item->product_image) }}" style="height: 300px" class="form-control @error('branch_image') is-invalid @enderror image-rounded" alt="">
            </div>
        </div>

       
        <div class="modal-footer">
            
            <a href="{{route('products.index')}}" class="btn btn-secondary">Close</a>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
    </form>

</div>

</div>
</div>
</div>
@endsection