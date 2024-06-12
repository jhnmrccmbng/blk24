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
                            <h3 class="m-0">{{ __('Store Branches') }} <span class="fa fa-plus"><a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#addbranch">Add Branch</a></span></h3>
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
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID No.</th>
                                <th>Branch Name</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($branches as $id => $branch)
                            <tr>
                                <td>{{$branch->id}}</td>
                                <td>{{$branch->restaurant_name}}</td>
                                <td>{{$branch->categories->category_name}}</td>
                                <td>{{$branch->restaurant_address}}</td>
                                <td>{{$branch->restaurant_email}}</td>
                                <td>{{$branch->restaurant_phone}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{route('restaurants.edit', $branch->id)}}" class="btn btn-success">Edit</a>
                                        <form action="{{ route('restaurants.destroy' , $branch->id)}}" method="POST">
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
<div class="modal fade" id="addbranch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

    <form method="POST" action="{{route('restaurants.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('Branch Category') }}</label>

            <div class="col-md-6">

                <select class="form-control @error('roles') is-invalid @enderror" name="category" required="">
                    <option value="">--- Please select---</option>
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
                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ old('branch_name') }}" required autocomplete="branch_name" autofocus>

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
                <input id="branch_address" type="text" class="form-control @error('branch_address') is-invalid @enderror" name="branch_address" value="{{ old('branch_address') }}" required autocomplete="branch_address" autofocus>

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
                <input id="branch_email" type="email" class="form-control @error('branch_email') is-invalid @enderror" name="branch_email" value="{{ old('branch_email') }}" required autocomplete="branch_email" autofocus>

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
                <input id="branch_phone" type="number" class="form-control @error('branch_phone') is-invalid @enderror" name="branch_phone" value="{{ old('branch_phone') }}" required autocomplete="branch_phone" autofocus>

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
                <input id="branch_url" type="text" class="form-control @error('branch_url') is-invalid @enderror" name="branch_url" value="{{ old('branch_url') }}" required autocomplete="branch_url" autofocus>

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
                <input id="openhrs" type="text" class="form-control @error('openhrs') is-invalid @enderror" name="openhrs" value="{{ old('openhrs') }}" required autocomplete="openhrs" autofocus>

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
                <input id="closehrs" type="text" class="form-control @error('closehrs') is-invalid @enderror" name="closehrs" value="{{ old('closehrs') }}" required autocomplete="closehrs" autofocus>

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
                <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ old('days') }}" required autocomplete="days" autofocus>

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
                <input id="branch_image" type="file" class="form-control @error('branch_image') is-invalid @enderror" name="branch_image" value="{{ old('branch_image') }}" required autocomplete="branch_image" autofocus accept="image/png, image/jpeg">

                @error('branch_image')
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