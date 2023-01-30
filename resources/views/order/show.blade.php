@extends('layouts.master')
@section('content')
     <div class="page-header">
        <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            {{-- <a href="{{url('mylist/create')}}">
            <button type="button" class="btn btn-outline-primary">Tambah Data</button>
            </a> --}}
          </div>
          
        </div>
        <h1 class="page-header-title"> </h1><br>
        
          <table class="">
            <thead>
                <tr>
                  <th>Kode Order</th>
                  <th> : {{$order->id_droping}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tanggal Order Kue</td>
                  <td> : {{$order->created_at}}</td>
                </tr>
                <tr>
                  <td>Total Kue</td>
                  <td> : {{$kues->sum('jumlah_droping')}}</td>
                </tr>
                <tr>
                  <td>Penerima</td>
                  <td> : {{$order->nama_pembeli}}</td>
                </tr>
                <tr>
                  <td>Status</td>
                    <td >@if($order->paid == 'paid')
                     : <span class="badge bg-soft-success text-success">Paid</span>
                  @else
                     : <span class="badge bg-soft-warning text-warning">Pesanan / Unpaid</span>   
                  @endif  
              </td>
                </tr>
      <tr><td>Total</td>
      <td>: @currency($total)</td></tr>

              </tbody>
          </table>

        <!-- End Row -->
      </div>
     <div class="container">
          <div class="row">
            <div class="col">
      <table class="table table-nowrap" id="example">
        <thead>
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Jumlah Order</th>
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($kues as $kue)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$kue->cookie->nama}}</td>
        <td>{{$kue->cookie->jenis}}</td>
        <td>{{$kue->cookie->harga}}</td>
        <td>{{$kue->jumlah_droping}}</td>
        {{-- <td>
          <form method="POST" action="{{route('mylist.destroy',$kue->id)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button>
                    <a href="{{route('mylist.edit',$kue->id)}}">
                      <button type="button" class="btn btn-warning btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a>
          </form>
        </td> --}}
        
      </tr> 
      @endforeach
      </tbody>
      </table>
     </div>
        @if($order->keterangan)
        <div class="col-md-5">
          <h4>Keterangan Order</h4>
        <p>{{$order->keterangan}}</p>
        </div>
        @endif
    </div>
          </div>
    <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>

      <script>
        $(document).ready(function () {
    $('#example').DataTable();
});
      </script>
@endsection