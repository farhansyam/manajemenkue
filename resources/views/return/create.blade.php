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
        <h1 class="page--title">Tambah Data return </h1>
<br>
        <div class="container">
          <form action="{{route('return.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="w-md-50">
  <div class="mb-3">
    
        @if($errors->any())
        <div class="alert alert-soft-danger" role="alert">
          Perhatikan Stok Kue
        </div>
    @endif
    <label class="form-label" for="exampleFormControlInput1">Akun Gudang tujuan : </label>
    		<select class="theSelect form-select form-select-hover-light" name="id_user">
      @foreach ($users as $user)
			<option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
		</select>
    
  </div>
    <div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Nota Return</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-archive"></i>
    </div>
    <input type="file" class="form-control" id="" required name="file" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
  <div class="mb-3">
    @php
        // if($errors->first('id_kue')){
        //   echo "data kue sudah ada , "
        // };
    @endphp
    <label class="form-label" for="exampleFormControlInput1">Stock Kue Gudang Ini : </label>
   
  </div>
                <!-- End Form -->
            </div>
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
                    <input type="number" required name="return[]" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan Jumlah">
                  </td>
                  <td><a href='javascript:void(0)' class="btn btn-danger drow btn-disable" >-</a></td>

                </tr>
              </tbody>
            </table>
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
                    <input type="number" required name="return[]" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan Jumlah">
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