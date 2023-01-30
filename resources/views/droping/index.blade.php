@extends('layouts.master')
@section('content')
     <div class="page-header">
        @if(auth()->user()->role != 96)
                <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            <a href="{{route('droping.create')}}">
            <button type="button" class="btn btn-outline-primary">New Droping </button>
            </a>
          </div>
          
        </div>
        @endif
        <h1 class="page-header-title">Droping List</h1>
        <!-- End Row -->
      </div>
      <div class="div class="table-responsive"">
      <table class="table table-nowrap" id="example">
        <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Status</th>
        <th>Tanggal Droping</th>
        <th>Option</th>
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($dropings as $droping)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$droping->user->name}}</td>
        <td >@if($droping->status == 2)
              <span class="badge bg-soft-success text-success">Approved</span>
               @elseif($droping->status == 9)
               <span class="badge bg-soft-danger text-warning">Decline</span>  
             @else
               <span class="badge bg-soft-warning text-warning">Pending</span>   
             @endif  
        </td>
        
        <td>{{date('d M Y',strtotime($droping->created_at))}}</td>
        <td>
          <form method="POST" action="{{route('droping.destroy',$droping->id_droping)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            @if($droping->status != 2)
                    <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button>
                    <a href="{{route('mylist.edit',$droping->id_droping)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a>
                    @endif        
                    <a href="{{route('droping.show',$droping->id_droping)}}">
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