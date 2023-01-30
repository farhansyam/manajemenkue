@extends('layouts.master')
@section('content')
<form action="{{route('trackkue-id')}}" method="get">
  <div class="mb-4 w-md-50">
  <div class="input-group input-group-merge">
    <input type="text" class="js-form-search form-control" name="key" value="{{$search}}" placeholder="Search..."
           data-hs-form-search-options='{
             "clearIcon": "#clearIcon2",
             "defaultIcon": "#defaultClearIconToggleEg"
           }'>
    <button type="button" class="input-group-append input-group-text">
      <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
      <i id="defaultClearIconToggleEg" class="bi-search" style="display: none;"></i>
    </button>
  </div>
</div>
</form>
     <div class="page-header">
       <!-- End Row -->
      </div>
      <h1 class="page-header-title">Tracking Kue Kue</h1>
      <div class="table-responsive">
      <table class="table table-nowrap" id="example">
        <thead>
        <tr>
        <th>No</th>
        <th>Kode Sales</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        {{-- <th>Jumlah Droping</th> --}}
        <th>Stock</th>
        {{-- <th>Terjual</th> --}}
        {{-- <th>Pesanan</th> --}}
        {{-- <th>Return</th> --}}
        {{-- <th>Setoran</th> --}}
        {{-- <th>Piutang</th --}}
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($kues as $kue)
         <tr>
        <td>{{$i++}}</td>
          {{-- @if($kue->who->role == 98)
            <td>Agen</td>
          @elseif($kue->who->role == 97) 
          <td>Koordinator Sales</td> 
          @else
          <td>Sales</td>
         @endif   --}}
        <td>{{$kue->who->kode_gudang_2.$kue->who->kode_gudang_3.$kue->who->name}}</td>
        <td>{{$kue->cookie->nama}}</td>
        <td>{{$kue->cookie->jenis}}</td>
        <td>@currency($kue->cookie->harga)</td>
        {{-- <td>{{$kue->jumlah_droping}}</td> --}}
        <td>{{$kue->stock}}</td>
        {{-- <td>{{$kue->terjual}}</td> --}}
        {{-- <td>{{$kue->pesanan}}</td> --}}
        {{-- <td>{{$kue->return}}</td> --}}
        {{-- <td>{{$kue->setoran}}</td> --}}
        {{-- <td>{{$kue->piutang}}</td> --}}
      </tr>

      @endforeach
      </tbody>
      </table>
      </div>
    <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>

      <script>
        $(document).ready(function () {
    $('#example').DataTable();
});
      </script>
@endsection