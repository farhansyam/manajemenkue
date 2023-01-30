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
            <form action="{{route('mylist.update',$kue->id)}}" method="POST">
              {{ method_field('PUT') }}
              <input type="text" name="id" id="" style="display: none" value="{{$kue->id}}">
                @csrf

              <div class="w-md-50">
  <div class="mb-3">
    <label class="form-label" for="exampleFormControlInput1">Kue : </label>
    		<select class="theSelect form-select form-select-hover-light" name="id_kue">
      @foreach ($cookie as $cook)
			<option {{ $cook->id == $kue->cookie->id ? 'selected' : '' }} value="{{$cook->id}}">{{$cook->nama}}</option>
      @endforeach
		</select>
  </div>
              <!-- Form -->
              <div class="mb-3">
                <label for="formControlHoverLightFullName" class="form-label">Jumlah</label>

                <input type="number" required name="jumlah_droping" class="form-control form-control-hover-light" id="formControlHoverLightFullName" value="{{$kue->jumlah_droping}}" placeholder="Masukan Jumlah">
              </div>
              <!-- End Form -->
              <!-- End Form -->
            </div>
            <button type="submit" class="btn btn-outline-primary">Tambah Data</button>
</form>            
        </div>

        	<script>
		$(".theSelect").select2();
	</script>
@endsection