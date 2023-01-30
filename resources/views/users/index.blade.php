@extends('layouts.master')
@section('content')
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
        <h1 class="page-header-title">Akun Agen</h1>
        @elseif(auth()->user()->role == 98)
        <h1 class="page-header-title">Akun Koor Sales</h1>
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
          @if(auth()->user()->role == 99)
            <th>Kode Agen</th>
          @elseif(auth()->user()->role == 98)
            <th>Kode Koordinator Sales</th>
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
                    <a href="{{route('users.detail',$user->id)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-eye"></i>
                      </button>
                    </a>
                    @if($user->approval == 0)
                    <a href="{{route('users.approvin',$user->id)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-check"></i>
                      </button>
                    </a>
                    @else
                    <a href="{{route('users.unapprovin',$user->id)}}">
                      <button type="button" class="btn btn-danger btn-icon">
                        <i class="bi-dash-circle"></i>
                      </button>
                    </a>
                    @endif
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