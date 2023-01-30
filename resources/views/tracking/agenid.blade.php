@extends('layouts.master')
@section('content')
  <!-- Form -->
<br><br><br>
<h3>Tracking Agen</h3>
<form action="{{route('trackagen-id')}}" method="get">
  <div class="mb-4 w-md-50">
  <div class="input-group input-group-merge">
    <input type="text" class="js-form-search form-control" name="key" placeholder="Search..."
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
<!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h1 class="page-header-title">Tracking Agen {{$user->name}}</h1>
            <h1 class="page-header-title">Kode Agen {{$user->kode_gudang_2}}</h1>
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
      <h3 class="title">Rekap Kue {{$user->name}}</h3>
      <br>
      <div class="row">
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5" >
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(133, 241, 133)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Stok</h6>

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
               <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5" >
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(124, 124, 124)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Distribute</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-9">
                  <h2 class="card-title text-inherit text-white">{{$jumlah_droping - $stock - $return}}</h2>
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
        <div class="col-sm-6 col-lg-2 mb-2 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100" href="#" style="background-color:rgb(0, 0, 0)">
            <div class="card-body">
              <h6 class="card-subtitle text-white">Return</h6>

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
         
            <h3 class="title">Rekap Tagihan {{$user->name}}</h3>
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
                    <h6 class="card-subtitle">Setoran</h6>
            
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

@endsection