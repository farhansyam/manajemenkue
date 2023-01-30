@extends('layouts.master')
@section('content')
     <div class="page-header">
        <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            <a href="{{route('return.create')}}">
            <button type="button" class="btn btn-outline-primary">New Return </button>
            </a>
          </div>
          
        </div>
        <h1 class="page-header-title">Return List</h1>
        <!-- End Row -->
      </div>
      <div class="div class="table-responsive"">
      <table class="table table-nowrap" id="example">
        <thead>
      <tr>
        <th>No</th>
        <th>Penerima</th>
        <th>Status</th>
        <th>Tanggal return</th>
        <th>Option</th>
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($returns as $return)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$return->user->name}}</td>
        <td >@if($return->status == 2)
              <span class="badge bg-soft-success text-success">Approved</span>
             @elseif($return  ->status == 9)
               <span class="badge bg-soft-danger text-warning">Decline</span>  
             @else
               <span class="badge bg-soft-warning text-warning">Pending</span>   
             @endif  
        </td>
        
        <td>{{date('d M Y',strtotime($return->created_at))}}</td>
        <td>
          <form method="POST" action="{{route('return.destroy',$return->id_droping)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                    @if($return->status !=2)
                    <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button>
                    <a href="{{route('return.edit',$return->id_droping)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a>
                    @endif
                    <a href="{{route('return.show',$return->id_droping)}}">
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