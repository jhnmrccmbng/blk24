@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @if (session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif  
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">{{ __('Inventory Management') }} <span class="fa fa-plus"><a class="btn btn-outline-primary btn-sm" href="#" data-toggle="modal" data-target="#addItem">Store Item</a></span></h3>
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

                    <table id="myTableInventory" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID no.</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Unit Price (₱)</th>
                                <th>Value (₱)</th>
                                <th>Purchase Date</th>
                                <th>Expiry Date</th>
                                <th>Stored Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    
                </section>
                
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @if (session('success1'))
              <div class="alert alert-success" role="alert">
                {{ session('success1') }}
            </div>
            @endif  
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">{{ __('Outgoing Items') }} <span class="fa fa-plus"><a class="btn btn-outline-secondary btn-sm" href="#" data-toggle="modal" data-target="#releaseItem">Release Item</a></span></h3>
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
                    <table id="myTableInventory1" class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>ID no.</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> 
                </section>
                
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

    <form method="POST" action="{{route('inventory.store')}}">
        @csrf

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('*Category') }}</label>

            <div class="col-md-6">

                <select class="form-control @error('roles') is-invalid @enderror" name="category" required="">
                    <option value="">--- Please select---</option>
                    @foreach($categories as $id => $catInventory)
                        <option value="{{$id}}">{{$catInventory}}</option>
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
            <label for="itemname" class="col-md-4 col-form-label text-md-right">{{ __('*Name') }}</label>

            <div class="col-md-6">
                <input id="itemname" type="text" class="form-control @error('itemname') is-invalid @enderror" name="itemname" value="{{ old('itemname') }}" required autocomplete="itemname" autofocus>

                @error('itemname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="itemdescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-6">

                <textarea class="form-control @error('itemdescription') is-invalid @enderror" name="itemdescription"></textarea>

                @error('itemdescription')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="itempurchasedate" class="col-md-4 col-form-label text-md-right">{{ __('*Purchase Date') }}</label>

            <div class="col-md-6">
                <input id="itempurchasedate" type="date" class="form-control @error('itempurchasedate') is-invalid @enderror" name="itempurchasedate" value="{{ old('itempurchasedate') }}" required autocomplete="itempurchasedate" autofocus>

                @error('itempurchasedate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

          <div class="form-group row">
            <label for="itemexpirydate" class="col-md-4 col-form-label text-md-right">{{ __('*Expiry Date') }}</label>

            <div class="col-md-6">
                <input id="itemexpirydate" type="date" class="form-control @error('itemexpirydate') is-invalid @enderror" name="itemexpirydate" value="{{ old('itemexpirydate') }}" required autocomplete="itemexpirydate" autofocus>

                @error('itemexpirydate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <hr>

           <div class="form-group row">
            <label for="itemqty" class="col-md-4 col-form-label text-md-right">{{ __('*Quantity') }}</label>

            <div class="col-md-6">
                <input id="itemqty" type="number" class="form-control @error('itemqty') is-invalid @enderror" name="itemqty" value="{{ old('itemqty') }}" required autocomplete="itemqty" autofocus>

                @error('itemqty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

         <div class="form-group row">
            <label for="itemprice" class="col-md-4 col-form-label text-md-right">{{ __('*Unit Price (₱)') }}</label>

            <div class="col-md-6">
                <input id="itemprice" type="number" class="form-control @error('itemprice') is-invalid @enderror" name="itemprice" value="{{ old('itemprice') }}" required autocomplete="itemprice" autofocus>

                @error('itemprice')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <hr>


         <div class="form-group row">
            <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

            <div class="col-md-6">

                <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks"></textarea>

                @error('remarks')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create Item</button>
        </div>
    </form>

</div>

</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="releaseItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Release Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

    <form method="GET" action="{{route('inventory.create')}}">
        @csrf
        {{ method_field('PUT') }}

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('*Item') }}</label>

            <div class="col-md-6">

                <select class="form-control @error('roles') is-invalid @enderror" name="itemid" required="">
                    <option value="">--- Please select---</option>
                    @foreach($items as $id => $item)
                        <option value="{{$item['id']}}">{{$item['inventory_name']}}_{{$item['inventory_itemID']}}</option>
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
            <label for="itemqty" class="col-md-4 col-form-label text-md-right">{{ __('*Quantity') }}</label>

            <div class="col-md-6">
                <input id="itemqty" type="number" class="form-control @error('itemqty') is-invalid @enderror" name="itemqty" value="{{ old('itemqty') }}" required autocomplete="itemqty" autofocus>

                @error('itemqty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <hr>


         <div class="form-group row">
            <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

            <div class="col-md-6">

                <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks"></textarea>

                @error('remarks')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save Item</button>
        </div>
    </form>

</div>

</div>
</div>
</div>

<script type="text/javascript">
    $(function () {
        
      var table = $('#myTableInventory').DataTable({
        
          processing: true,
          serverSide: true,
          ajax: "{{ route('inventory.index') }}",
          columns: [
              {data: 'itemID', name: 'itemID'},
              {data: 'name', name: 'name'},
              {data: 'category', name: 'category'},
              {data: 'qty', name: 'qty'},
              {data: 'price', name: 'price'},
              {data: 'value', name: 'value'},
              {data: 'purchasedate', name: 'purchasedate'},
              {data: 'expirydate', name: 'expirydate'},
              {data: 'createdat', name: 'createdat'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action'},
          ], 

      });

      var table = $('#myTableInventory1').DataTable({
        
          processing: true,
          serverSide: true,
          ajax: "{{ route('inventory.index') }}",
          columns: [
              {data: 'itemID', name: 'itemID'},
              {data: 'name', name: 'name'},
              {data: 'qty', name: 'qty'},
              {data: 'action', name: 'action'},
          ], 

      });
      
    });
</script>
@endsection