@extends('layouts.master')
@section('content')
    <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h1 class="page-header-title">Detail Akun Gudang {{$gudang->name}}</h1>
          </div>
          
          <!-- End Col -->

          <div class="col-auto">
          </div>
          
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->
      
      <!-- Stats -->
      <h3 class="title">Rekap Kue</h3>
      <br>
     <div class="row">

        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5" >
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(133, 241, 133)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Gudang</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$stock}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
        @if(auth()->user()->role !=96)
                <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5" >
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(84, 89, 84)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Distribute</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$jumlah_droping - $return - $stock}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
        @endif
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(34, 196, 237)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Droping</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$jumlah_droping}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(255, 123, 90)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Terjual</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$terjual}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(237, 156, 34)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Pesanan</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$pesanan}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
@if(auth()->user()->role !=96)
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(0, 0, 0)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Return Masuk</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$returnmasuk}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
@endif
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(0, 0, 0)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Return Keluar</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$return}}</h2>
                </div>
                <!-- End Col -->

                <!-- End Col -->
              </div>
              <!-- End Row -->

              </span>
            </div>
          </a>
          <!-- End Card -->
        </div>
         
            <h3 class="title">Rekap Tagihan Saya</h3>
            <br><br>
            <div class="row">
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Total Tagihan</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">@currency($total)</h2>
                      </div>
                      <!-- End Col -->
            
                      <div class="col-3">
                        <!-- Chart -->
                        <span class="icon" height="200">
                          <i class="bi-cash-coin"></i>
                        </span>
                        <!-- End Chart -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
            
                    </span>
                  </div>
                </a>
                <!-- End Card -->
              </div>
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Setoran Keluar</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">@currency($total2)</h2>
                      </div>
                      <!-- End Col -->
            
                      <div class="col-3">
                        <!-- Chart -->
                        <span class="icon" height="200">
                          <i class="bi-calendar-week"></i>
                        </span>
                        <!-- End Chart -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
            
                    </span>
                  </div>
                </a>
                <!-- End Card -->
              </div>
              @if(auth()->user()->role != 96)
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Setoran Masuk</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">@currency($total4)</h2>

                      </div>
                      <!-- End Col -->
            
                      <div class="col-3">
                        <!-- Chart -->
                        <span class="icon" height="200">
                          <i class="bi-calendar-week"></i>
                        </span>
                        <!-- End Chart -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
            
                    </span>
                  </div>
                </a>
                <!-- End Card -->
              </div>
              @endif
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Piutang</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">@currency($total3)</h2>
                      </div>
                      <!-- End Col -->
            
                      <div class="col-3">
                        <!-- Chart -->
                        <span class="icon" height="200">
                          <i class="bi-cart-check-fill"></i>
                        </span>
                        <!-- End Chart -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
            
                    </span>
                  </div>
                </a>
                <!-- End Card -->
              </div>
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Sisa Tagihan</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">@currency($total-$total2)</h2>
                      </div>
                      <!-- End Col -->
            
                      <div class="col-3">
                        <!-- Chart -->
                        <span class="icon" height="200">
                          <i class="bi-list"></i>
                        </span>
                        <!-- End Chart -->
                      </div>
                      <!-- End Col -->
                    </div>
                    <!-- End Row -->
            
                    </span>
                  </div>
                </a>
                <!-- End Card -->
              </div>
            </div>
      </div>

      
        <div class="div class="table-responsive"">
      <table class="table table-nowrap" id="example">
        <thead>
        @if(auth()->user()->role == '99')
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Jumlah Droping</th>
        <th>Stock</th>
        <th>Datang</th>
        <th>Opsi</th>
      </tr>
        @else
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Jumlah Droping</th>
        <th>Stock</th>
        <th>Terjual</th>
        <th>Pesanan</th>
        <th>Return</th>
        <th>Setoran</th>
        <th>Piutang</th>
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
        <td>{{$kue->stock}}</td>
        <td>{{date('d M Y',strtotime($kue->created_at))}}</td>
        <td>
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
        </td>
        
      </tr> 
        @else
         <tr>
        <td>{{$i++}}</td>
        <td>{{$kue->cookie->nama}}</td>
        <td>{{$kue->cookie->jenis}}</td>
        <td>{{$kue->cookie->harga}}</td>
        <td>{{$kue->jumlah_droping}}</td>
        <td>{{$kue->stock}}</td>
        <td>{{$kue->terjual}}</td>
        <td>{{$kue->pesanan}}</td>
        <td>{{$kue->return}}</td>
        <td>{{$kue->setoran}}</td>
        <td>{{$kue->piutang}}</td>
      </tr>
        @endif

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
