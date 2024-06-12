@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="container" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    @if (session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <a href="{{route('inventory.index')}}" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">

        <form method="POST" action="{{route('inventory.update', $item->id)}}">
          @csrf

          {{ method_field('PUT') }}

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-primary">{{ __('*Category') }}</label>

            <div class="col-md-6">

              <select class="form-control @error('roles') is-invalid @enderror" name="category" required="">
                <option value="{{$item->inventory_categoryID}}">{{$item->categoryInventory->inv_categoryname}}</option>
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
              <input id="itemname" type="text" class="form-control @error('itemname') is-invalid @enderror" name="itemname" value="{{ $item->inventory_name }}" required autocomplete="itemname" autofocus>

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

              <textarea class="form-control @error('itemdescription') is-invalid @enderror" name="itemdescription">{{ $item->inventory_desc }}</textarea>

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
              <input id="itempurchasedate" type="date" class="form-control @error('itempurchasedate') is-invalid @enderror" name="itempurchasedate" value="{{ $item->inventory_purchasedate }}" required autocomplete="itempurchasedate" autofocus>

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
              <input id="itemexpirydate" type="date" class="form-control @error('itemexpirydate') is-invalid @enderror" name="itemexpirydate" value="{{ $item->inventory_expirydate }}" required autocomplete="itemexpirydate" autofocus>

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
              <input id="itemqty" type="number" class="form-control @error('itemqty') is-invalid @enderror" name="itemqty" value="{{ $item->inventory_quantity }}" required autocomplete="itemqty" autofocus>

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
              <input id="itemprice" type="number" class="form-control @error('itemprice') is-invalid @enderror" name="itemprice" value="{{ $item->inventory_unitprice }}" required autocomplete="itemprice" autofocus>

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

              <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks">{{$item->inventory_remarks}}</textarea>

              @error('remarks')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right text-secondary">{{ __('*Status') }}</label>

            <div class="col-md-6">

              <select class="form-control @error('roles') is-invalid @enderror" name="status" required="">
                <option value="{{$item->inventory_statusID}}">{{$item->statusInventory->status_name}}</option>
                @foreach($statuses as $id => $status)
                    <option value="{{$id}}">{{$status}}</option>
                @endforeach
              </select>

              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>


          <div class="modal-footer">
            <a href="{{url('/inventory/destroy', $item->id)}}" class="btn btn-danger" onclick="return confirm('Are you really want to delete this item?')">Delete</a>
            <button type="submit" class="btn btn-success">Save Changes</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>
@endsection