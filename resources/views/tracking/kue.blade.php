@extends('layouts.master')
@section('content')
  <!-- Form -->

<br><br><br>
<h3>Tracking Kue</h3>
<!-- Form -->
<form action="{{route('trackkue-id')}}" method="get">
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
<!-- End Form -->
@endsection