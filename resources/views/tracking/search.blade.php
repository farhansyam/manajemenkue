@extends('layouts.master')
@section('content')
  <!-- Form -->

<br><br><br>
@if(auth()->user()->role == 99)
<h3>Tracking</h3>
<a href="{{route('trackkue')}}">
  <button type="button" class="btn btn-primary">
  By Nama kue
</button>
</a>

<a href="{{route('trackagen')}}">
  <button type="button" class="btn btn-primary">
  Tracking Agen
</button>
</a>

<a href="{{route('trackkoor')}}">
  <button type="button" class="btn btn-primary">
  Tracking Koor Sales
</button>
</a>

<a href="{{route('tracksales')}}">
  <button type="button" class="btn btn-primary">
    Tracking Sales
  </button>
</a>
@elseif(auth()->user()->role == 98)
<h3>Tracking</h3>

<a href="{{route('trackkoor')}}">
  <button type="button" class="btn btn-primary">
  Tracking Koor Sales
</button>
</a>

<a href="{{route('tracksales')}}">
  <button type="button" class="btn btn-primary">
    Tracking Sales
  </button>
</a>

@else
<h3>Tracking</h3>


<a href="{{route('tracksales')}}">
  <button type="button" class="btn btn-primary">
    Tracking Sales
  </button>
</a>
@endif
@endsection