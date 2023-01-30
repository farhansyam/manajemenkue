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
        <h1 class="page--title">Tambah Data Droping </h1>
<br>
        <div class="container">
            <form action="{{route('mylist.store')}}" method="POST">
                @csrf
              <div class="w-md-50">
  <div class="mb-3">
    @php
        if($errors->first('id_kue')){
          echo "data kue sudah ada ";
        }
    @endphp
    <label class="form-label" for="exampleFormControlInput1">Kue : </label>
    		<select class="theSelect form-select form-select-hover-light" name="id_kue">
      @foreach ($kues as $kue)
			<option value="{{$kue->id}}">{{$kue->nama}}</option>
      @endforeach
		</select>
  </div>
              <!-- Form -->
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Jumlah</label>

                <input type="number" required name="jumlah_droping" class="form-control form-control-hover-light" id="formControlHoverLightFullName" placeholder="Masukan Jumlah">
              </div>
              <!-- End Form -->
              <!-- End Form -->
            </div>
            <button type="submit" class="btn btn-outline-primary">Submit</button>
</form>            
        </div>

        	<script>
		$(".theSelect").select2();
	</script>
@endsection