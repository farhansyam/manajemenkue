@extends('layouts.master')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>



     <div class="page-header">
        <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
          </div>
          
        </div>
        <!-- End Row -->
      </div>
        <h1 class="page--title">Tambah Data Order </h1>
<br>
        <div class="container">
          <form action="{{route('order.store')}}" method="POST">
                @csrf
                           <table class="table table-bordered">
              <thead>
                <tr>
                  <td>Kue</td>
                  <td>Jumlah</td>
                  <td><a href="#" onclick="adder()" class="btn btn-success addRow">+</a></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select class="theSelect form-select form-select-hover-light" name="id_kue[]">
                      @foreach ($kues as $kue)
                        <option value="{{$kue->cookie->id}}">{{$kue->cookie->nama}} - Stock : {{$kue->stock}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" required name="jumlah_droping[]" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan Jumlah">
                  </td>
                  <td><a href='javascript:void(0)' class="btn btn-danger drow btn-disable" >-</a></td>

                </tr>
              </tbody>
            </table>
              <div class="w-md-50">
                
  <div class="mb-3">
    
        @if($errors->any())
        <div class="alert alert-soft-danger" role="alert">
          Perhatikan Stok Kue
        </div>
    @endif
  </div>
  
  <div class="mb-3">
    @php
        // if($errors->first('id_kue')){
        //   echo "data kue sudah ada , "
        // };
    @endphp
    
   
  </div>
              <!-- Form -->
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Nama Konsumen</label>
                    <input type="text" required name="nama" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Nama Konsumen">

              </div>
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="" cols="30" rows="5"></textarea>
              </div>
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="" cols="2" rows="2"></textarea>
              </div>
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Status</label>
                <select name="statusPaid" id="" class="form-control">
                  <option value="pesanan">Pesanan / Unpaid</option>
                  <option value="paid">Terjual / Paid</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">No Hp</label>
                    <input type="text" required name="no_hp" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan No Hp">

              </div>
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Tanggal Pengiriman</label>
                    <input type="date" required name="tanggal" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan tanggal">

              </div>
              <!-- End Form -->
              <!-- End Form -->
            </div>
 
            <button type="submit" class="btn btn-outline-primary">Submit</button>
</form>            
        </div>
        <script>
          function adder(){
             var tr =  `
                        <tr>
                  <td>
                    <select class="theSelect form-select form-select-hover-light" name="id_kue[]">
                      @foreach ($kues as $kue)
                        <option value="{{$kue->cookie->id}}">{{$kue->cookie->nama}} - Stock : {{$kue->stock}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="number" required name="jumlah_droping[]" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan Jumlah">
                  </td>
                  <td><a href="javascript:void(0)" onclick="deleter()" class="btn btn-danger drow">-</a></td>

                </tr>`
             $('tbody').append(tr);
          }

          $('tbody').on('click','.drow',function(){
            $(this).parent().parent().remove()

          })
        </script>
        	<script>
		$(".theSelect").select2();
	</script>
@endsection