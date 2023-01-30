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
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Stok</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit">{{$stock}}</h2>
                </div>
                <!-- End Col -->

                <div class="col-3">
                  <!-- Chart -->
                <span class="icon" height="200">
                  <i class="bi-archive"></i>
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
                <h6 class="card-subtitle">Dropping</h6>
          
                <div class="row align-items-center gx-2 mb-1">
                  <div class="col-9">
                    <h2 class="card-title text-inherit">{{$jumlah_droping}}</h2>
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
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
              <!-- Card -->
              <a class="card card-hover-shadow h-100" href="#">
                <div class="card-body">
                  <h6 class="card-subtitle">Terjual</h6>
            
                  <div class="row align-items-center gx-2 mb-1">
                    <div class="col-9">
                      <h2 class="card-title text-inherit">540</h2>
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
                <h6 class="card-subtitle">Pesanan</h6>
          
                <div class="row align-items-center gx-2 mb-1">
                  <div class="col-9">
                    <h2 class="card-title text-inherit">540</h2>
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
          <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#">
            <div class="card-body">
              <h6 class="card-subtitle">Return</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit">540</h2>
                </div>
                <!-- End Col -->

                <div class="col-3">
                  <!-- Chart -->
                <span class="icon" height="200">
                  <i class="bi-caret-left-square"></i>
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
            <h3 class="title">Rekap Tagihan Saya</h3>
            <br>
            <div class="row">
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Total Tagihan</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">Rp.500000</h2>
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
                    <h6 class="card-subtitle">Setoran</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">540</h2>
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
              <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <a class="card card-hover-shadow h-100" href="#">
                  <div class="card-body">
                    <h6 class="card-subtitle">Piutang</h6>
            
                    <div class="row align-items-center gx-2 mb-1">
                      <div class="col-9">
                        <h2 class="card-title text-inherit">540</h2>
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
                        <h2 class="card-title text-inherit">540</h2>
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
       <div class="page-header">
        <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            <a href="{{route('users.create')}}">
            <button type="button" class="btn btn-outline-primary">Tambah Akun</button>
            </a>
          </div>
          
        </div>
        @if(auth()->user()->role == 99)
        <h1 class="page-header-title">Akun Gudang 2</h1>
        @elseif(auth()->user()->role == 98)
        <h1 class="page-header-title">Akun Gudang 3</h1>
        @elseif(auth()->user()->role == 97)
        <h1 class="page-header-title">Akun Sales</h1>
        @endif

        <!-- End Row -->
      </div>
      <div class="div class="table-responsive"">
      <table class="table table-nowrap" id="example">
        <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Email</th>
          @if(auth()->user()->role == 99 || auth()->user()->role == 98 || auth()->user()->role == 97)
            <th>Kode Gudang</th>
          @else
            <th>Kode Sales</th>
          @endif    
        <th>Opsi</th>
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($users as $user)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
          @if(auth()->user()->role == 99)
            <td>{{$user->kode_gudang_2}}</td>
          @elseif(auth()->user()->role == 98)
            <td>{{$user->kode_gudang_3}}</td>
          @else
            <td>{{$user->kode_sales}}</td>
          @endif    
        
        <td>
          <form method="POST" action="{{route('users.destroy',$user->id)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button>
                    <a href="{{route('users.edit',$user->id)}}">
                      <button type="button" class="btn btn-warning btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a>
                    <a href="{{route('users.detailgudang',$user->id)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-eye"></i>
                      </button>
                    </a>
          </form>
        </td>

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
