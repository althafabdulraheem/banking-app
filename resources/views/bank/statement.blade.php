@extends('layouts.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center h-100">
       <div class="card">
            <div class="card-header">
                <h1 class="fs-3 text-center">Statements</h1>
            </div>
       
        <div class="table-wrapper ">
            <table class="table table-bordered" id="statement-table">
                <thead>
                    <tr>
                        <td></td>
                        <td>DATE TIME</td>
                        <td>AMOUNT</td>
                        <td>TYPE</td>
                        <td>DETAILS</td>
                        <td>BALANCE</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statements as $statement)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{\Carbon\Carbon::parse($statement->created_at)->format('d-m-y h:i a')}}</td>
                        <td>{{$statement->amount}}</td>
                        <td>{{$statement->type}}</td>
                        <td>{{$statement->details}}</td>
                        <td>{{$statement->balance}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            
        </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
     $(document).ready(function() {
        $('#statement-table').DataTable();
    });
</script>
@endsection