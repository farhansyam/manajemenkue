@extends('layouts.master')
@section('content')
     <div class="page-header">
        @if(auth()->user()->role == 99)
               <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            <a href="{{url('mylist/create')}}">
            <button type="button" class="btn btn-outline-primary">Tambah Data</button>
            </a>
          </div>
          
        </div>
        @endif
        <h1 class="page-header-title">Mylist Kue</h1>
        <!-- End Row -->
      </div>
      <div class="table-responsive">
      <table class="table table-nowrap" id="example">
  @if(auth()->user()->role !=96)
        <thead>
      </tr>
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Jumlah Droping</th>
        <th>Stock</th>
        <th>Terjual</th>
        <th>Pesanan</th>
        <th>Return (-)</th>
        <th>Return (+)</th>
        <th>Setoran</th>
        <th>Optional</th>
      </tr>
      
      </thead>
  @elseif(auth()->user()->role !=96 and auth()->user()->role != 99)
        <thead>
      </tr>
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Jumlah Droping</th>
        <th>Stock</th>
        <th>Terjual</th>
        <th>Pesanan</th>
        <th>Return (-)</th>
        <th>Return (+)</th>
        <th>Setoran</th>
        <th>Option</th>
      </tr>
      
      </thead>
      @else
            <thead>
      </tr>
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Jumlah Droping</th>
        <th>Stock</th>
        <th>Terjual</th>
        <th>Pesanan</th>
        <th>Return (-)</th>
        <th>Setoran</th>
      </tr>
@endif      
      </thead>

    @if(auth()->user()->role == 99)
      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($kues as $kue)
      </tr> 
         <tr>
        <td>{{$i++}}</td>
        <td>{{$kue->cookie->nama}}</td>
        <td>{{$kue->cookie->jenis}}</td>
        <td>@currency($kue->cookie->harga)</td>
        <td>{{$kue->jumlah_droping}}</td>
        <td>{{$kue->stock}}</td>
        <td>{{$kue->terjual}}</td>
        <td>{{$kue->pesanan}}</td>
        <td>{{$kue->return}}</td>
        <td>{{$kue->return_masuk}}</td>
        <td>{{$kue->setoran}}</td>
               <td>
           <form method="POST" action="{{route('mylist.destroy',$kue->id)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button>
                    <a href="{{route('mylist.edit',$kue->id)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a>
          </form>
        </td>
      </tr>

      @endforeach
      </tbody>
      @elseif(auth()->user()->role !=96 and auth()->user()->role != 99)
              @foreach($kues as $kue)
      </tr> 
         <tr>
        <td>{{$i++}}</td>
        <td>{{$kue->cookie->nama}}</td>
        <td>{{$kue->cookie->jenis}}</td>
        <td>@currency($kue->cookie->harga)</td>
        <td>{{$kue->jumlah_droping}}</td>
        <td>{{$kue->stock}}</td>
        <td>{{$kue->terjual}}</td>
        <td>{{$kue->pesanan}}</td>
        <td>{{$kue->return}}</td>
        <td>{{$kue->return_masuk}}</td>
        <td>{{$kue->setoran}}</td>
 
      </tr>

      @endforeach
      @else
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($kues as $kue)
      </tr> 
         <tr>
        <td>{{$i++}}</td>
        <td>{{$kue->cookie->nama}}</td>
        <td>{{$kue->cookie->jenis}}</td>
        <td>@currency($kue->cookie->harga)</td>
        <td>{{$kue->jumlah_droping}}</td>
        <td>{{$kue->stock}}</td>
        <td>{{$kue->terjual}}</td>
        <td>{{$kue->pesanan}}</td>
        <td>{{$kue->return}}</td>
        <td>{{$kue->setoran}}</td>
      </tr>

      @endforeach
      </tbody>
    @endif
      </table>
      </div>
    <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>

      <script>
        $(document).ready(function () {
    $('#example').DataTable();
});
      </script>
@endsection