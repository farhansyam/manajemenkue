@extends('layouts.master')
@section('content')
     <div class="page-header">
        <div class="row align-items-center">
       
        </div>
        <h1 class="page-header-title"> </h1><br>
          <table class="">
            <thead>
                <tr>
                  <th>Kode Droping</th>
                  <th> : {{$Setoran->id_droping}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tanggal Droping Kue</td>
                  <td> : {{$Setoran->created_at}}</td>
                </tr>
                <tr>
                  <td>Total Kue</td>
                  <td> : {{$kues->sum('jumlah_droping')}}</td>
                </tr>
                <tr>
                  <td>Penerima</td>
                  <td> : {{$Setoran->user->name}}</td>
                </tr>
                <tr>
                  <td>Status</td>
                    <td >@if($Setoran->status == 2)
                     : <span class="badge bg-soft-success text-success">Approved</span>
                  @else
                     : <span class="badge bg-soft-warning text-warning">Pending</span>   
                  @endif  
              </td>
                </tr>
                <tr>
                  <td>Total :</td>
                  <td>@currency($total)</td>
                </tr>
              </tbody>
          </table>
          </div>

        <!-- End Row -->
      </div>
      <div class="container">
          <div class="row">
            <div class="col">
            <table class="table table-nowrap" id="">
            <thead>
            @if(auth()->user()->role == '99')
          <tr>
            <th style="width: 100px">No</th>
            <th width="100">Name</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Jumlah Droping</th>
            {{-- <th>Opsi</th> --}}
          </tr>
            @else
            <tr>
            <th style="width: 100px">No</th>
            <th style="width: 100px">Name</th>
            <th style="width: 100px">Jenis</th>
            <th style="width: 100px">Harga</th>
            <th>Jumlah Droping</th>
          </tr>
            @endif
          
          </thead>

          <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($kues as $kue)
            @if(auth()->user()->role == '99')
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
            @else
              <tr>
            <td>{{$i++}}</td>
            <td>{{$kue->cookie->nama}}</td>
            <td>{{$kue->cookie->jenis}}</td>
            <td>{{$kue->cookie->harga}}</td>
            <td>{{$kue->jumlah_droping}}</td>
          </tr>
            @endif

          @endforeach
          
        </tbody>
      </table>
      </div>
        @if($Setoran->gambar)
      <div class="col-md-5"><img src="{{asset('data_file').'/'.$Setoran->gambar}}" alt="" width="300"></div>
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