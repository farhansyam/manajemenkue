@extends('layouts.master')
@section('content')
     <div class="page-header">
        @if(auth()->user()->role == 96)
                <div class="row align-items-center">
          <div class="col"></div>
          <div class="col-auto">
            <a href="{{route('order.create')}}">
            <button type="button" class="btn btn-outline-primary">New Piutang</button>
            </a>
          </div>
          
        </div>
        @endif
        <h1 class="page-header-title">Piutang List</h1>
        <!-- End Row -->
      </div>
      <div class="div class="table-responsive"">
      <table class="table table-nowrap" id="example">
        <thead>
      <tr>
        <th>No</th>
        <th>Konsumen</th>
        <th>Status</th>
        <th>Tanggal Order</th>
        <th>Option</th>
      </tr>
      
      </thead>

      <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($piutangs as $order)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$order->nama_pembeli}}</td>
        <td >@if($order->paid == 'paid')
              <span class="badge bg-soft-success text-success">Paid</span>
             @else
               <span class="badge bg-soft-warning text-warning">Unpaid / Blm bayar</span>   
             @endif  
        </td>
        
        <td>{{date('d M Y',strtotime($order->created_at))}}</td>
        <td>
          <form method="POST" action="{{route('order.destroy',$order->id_droping)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-icon">
                      <i class="bi-trash"></i>
                    </button>
                    {{-- <a href="{{route('order.edit',$order->id_droping)}}">
                      <button type="button" class="btn btn-warning btn-icon">
                        <i class="bi-pencil"></i>
                      </button>
                    </a> --}}
                    <a href="{{route('order.show',$order->id_droping)}}">
                      <button type="button" class="btn btn-warning btn-icon">
                        <i class="bi-eye"></i>
                      </button>
                    </a>

                      <a href="{{route('order.move',$order->id_droping)}}">
                      <button type="button" class="btn btn-success btn-icon">
                        <i class="bi-check"></i>
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