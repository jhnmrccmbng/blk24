@extends('layouts.app')

@section('content')

<div class="" id="addbranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Branch</h5>
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

    <form method="POST" action="{{route('restaurants.update', $branch->id)}}" enctype="multipart/form-data">

        @csrf
        {{ method_field('PATCH') }}

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('Branch Category') }}</label>

            <div class="col-md-6">

                <select class="form-control @error('roles') is-invalid @enderror" name="category" required="">
                    <option value="{{$branch->restaurant_category_id}}">{{$branch->categories->category_name}}</option>
                    @foreach($categories as $id => $category)
                      <option value="{{$id}}">{{$category}}</option>
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
            <label for="branch_name" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name') }}</label>

            <div class="col-md-6">
                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{$branch->restaurant_name}}" required autocomplete="branch_name" autofocus>

                @error('branch_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="branch_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

            <div class="col-md-6">
                <input id="branch_address" type="text" class="form-control @error('branch_address') is-invalid @enderror" name="branch_address" value="{{$branch->restaurant_address}}" required autocomplete="branch_address" autofocus>

                @error('branch_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="branch_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

            <div class="col-md-6">
                <input id="branch_email" type="email" class="form-control @error('branch_email') is-invalid @enderror" name="branch_email" value="{{$branch->restaurant_email}}" required autocomplete="branch_email" autofocus>

                @error('branch_email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="branch_phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

            <div class="col-md-6">
                <input id="branch_phone" type="number" class="form-control @error('branch_phone') is-invalid @enderror" name="branch_phone" value="{{$branch->restaurant_phone}}" required autocomplete="branch_phone" autofocus>

                @error('branch_phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

          <div class="form-group row">
            <label for="branch_url" class="col-md-4 col-form-label text-md-right">{{ __('Website URL') }}</label>

            <div class="col-md-6">
                <input id="branch_url" type="text" class="form-control @error('branch_url') is-invalid @enderror" name="branch_url" value="{{$branch->restaurant_url}}" required autocomplete="branch_url" autofocus>

                @error('branch_url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

          <div class="form-group row">
            <label for="openhrs" class="col-md-4 col-form-label text-md-right">{{ __('Open Hours') }}</label>

            <div class="col-md-6">
                <input id="openhrs" type="text" class="form-control @error('openhrs') is-invalid @enderror" name="openhrs" value="{{$branch->restaurant_openhour}}" required autocomplete="openhrs" autofocus>

                @error('openhrs')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="closehrs" class="col-md-4 col-form-label text-md-right">{{ __('Close Hours') }}</label>

            <div class="col-md-6">
                <input id="closehrs" type="text" class="form-control @error('closehrs') is-invalid @enderror" name="closehrs" value="{{$branch->restaurant_closehour}}" required autocomplete="closehrs" autofocus>

                @error('closehrs')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('Days') }}</label>

            <div class="col-md-6">
                <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{$branch->restaurant_days}}" required autocomplete="days" autofocus>

                @error('days')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="branch_image" class="col-md-4 col-form-label text-md-right">{{ __('Branch Image') }}</label>

            <div class="col-md-6">
                <input id="branch_image" type="file" class="form-control @error('branch_image') is-invalid @enderror" name="branch_image" value="" accept="image/png, image/jpeg">

                @error('branch_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        @if($branch->restaurant_imagepath != null)
          <div class="form-group row">
              <label for="branch_image" class="col-md-4 col-form-label text-md-right"></label>

              <div class="col-md-6">
        
                   <img src="{{ url('storage/'.$branch->restaurant_imagepath) }}" style="height: 300px" class="form-control @error('branch_image') is-invalid @enderror image-rounded" alt="">
              </div>
          </div>
        @endif

        <div class="modal-footer">
            <a href="{{route('restaurants.index')}}" class="btn btn-secondary">Close</a>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
    </form>

</div>

</div>
</div>
</div>

@endsection