@extends('layouts.master')
@section('content')
     <div class="page-header">
                <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            <a href="{{route('setoran.create')}}">
            <button type="button" class="btn btn-outline-primary">New Setoran </button>
            </a>
          </div>
          
        </div>
        <h1 class="page-header-title">Setoran List</h1>
        <!-- End Row -->
      </div>
      <div class="div class="table-responsive"">
      <table class="table table-nowrap" id="example">
        <thead>
      <tr>
        <th>No</th>
        <th>Tujuan</th>
        <th>Status</th>
        <th>Tanggal Setoran</th>
        <th>Option</th>
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($setorans as $Setoran)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$Setoran->user->name}}</td>
        <td >@if($Setoran->status == 2)
              <span class="badge bg-soft-success text-success">Approved</span>
             @else
               <span class="badge bg-soft-warning text-warning">Pending</span>   
             @endif  
        </td>
        
        <td>{{date('d M Y',strtotime($Setoran->created_at))}}</td>
        <td>
          <form method="POST" action="{{route('setoran.destroy',$Setoran->id_droping)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                    {{-- <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button> --}}
                    {{-- <a href="{{route('Setoran.edit',$Setoran->id_droping)}}">
                      <button type="button" class="btn btn-warning btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a> --}}
                    <a href="{{route('setoran.show',$Setoran->id_droping)}}">
                      <button type="button" class="btn btn-warning btn-icon">
                        <i class="bi-eye"></i>
                      </button>
                    </a>
          </form>
        </td>
        
      </tr> 

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