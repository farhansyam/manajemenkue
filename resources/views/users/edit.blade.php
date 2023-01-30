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
        <h1 class="page--title">Tambah Akun Gudang </h1>
<br>
        <div class="container">
            <form action="{{route('users.update',$user->id)}}" method="POST">
                @csrf
                      {{ method_field('PUT') }}
              <input type="text" name="id" id="" style="display: none" value="{{$user->id}}">
             <!-- Input Group -->
<div class="mb-3">
  <label for="inputGroupMergeFullName" class="form-label">Username</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeFullNameAddOn">
      <i class="bi-person"></i>
    </div>
    <input value="{{$user->name}}" name="name" type="text" class="form-control" id="inputGroupMergeFullName" placeholder="Masukan username" aria-label="Masukan username" aria-describedby="inputGroupMergeFullNameAddOn">
  </div>
</div>
<!-- End Input Group -->

<!-- Input Group -->
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Email</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-envelope-open"></i>
    </div>
    <input value="{{$user->email}}" name="email" type="email" class="form-control" id="" placeholder="farhan@example.com" aria-label="farhan@example.com" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
<!-- End Input Group -->

<!-- Input Group -->
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Password</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-lock"></i>
    </div>
    <input name="password" placeholder="password baru" required type="password" class="form-control" id="" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">No Telepon</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-phone"></i>
    </div>
    <input value="{{$user->no_tlpn}}" type="text" name="no_telepon" class="form-control" id="" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
@if (auth()->user()->role == 99)
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Kode Agen</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-archive"></i>
    </div>
    <input value="{{$user->kode_gudang_2}}" type="text" class="form-control" id="" name="kode_gudang" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
@elseif(auth()->user()->role == 98)
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Kode Koordinator Sales</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-archive"></i>
    </div>
    <input value="{{$user->kode_gudang_3}}" type="text" class="form-control" id="" name="kode_gudang" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
@elseif(auth()->user()->role == 97)
<div class="mb-3">
  <label for="inputGroupMergeEmail" class="form-label">Kode Sales</label>

  <div class="input-group input-group-merge">
    <div class="input-group-prepend input-group-text" id="inputGroupMergeEmailAddOn">
      <i class="bi-archive"></i>
    </div>
    <input value="{{$user->kode_sales}} type="text" class="form-control" id="" name="kode_gudang" aria-describedby="inputGroupMergeEmailAddOn">
  </div>
</div>
@endif


<!-- End Input Group -->

<!-- Input Group -->
<!-- End Input Group -->
            <button type="submit" class="btn btn-outline-primary">Tambah Data</button>
</form>            
        </div>

        	<script>
		$(".theSelect").select2();
	</script>
@endsection
            <form action="{{route('users.update',$user->id)}}" method="POST">
              {{ method_field('PUT') }}
              <input type="text" name="id" id="" style="display: none" value="{{$user->id}}">
                @csrf

       