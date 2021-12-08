@extends('layouts.app')

@section('content')
    <div class="row">
        <table id="services-tbl" class="table table-striped">
            <thead>
            <tr>
                <th>Service name</th>
                <th>Service type</th>
                <th>A-End port</th>
                <th>Speed</th>
            </tr>
            </thead>
            <tbody>
            @forelse($services as $service)
                <tr>
                    <td><a href="services/{{ $service['id'] }}">{{ $service['name'] }}</a></td>
                    <td>{{ $service['type'] }}</td>
                    <td>{{ $service['port']['name'] }}</td>
                    <td>{{ $service['bandwidth'] }}</td>
                </tr>
            @empty
                <tr><td>No Services</td></tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>Service name</th>
                <th>Service type</th>
                <th>A-End port</th>
                <th>Speed</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#services-tbl').DataTable();
        } );
    </script>

    <style>
        #services-tbl {
            width:100%;
        }
    </style>
@endpush