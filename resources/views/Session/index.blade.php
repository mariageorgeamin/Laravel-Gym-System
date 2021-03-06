@extends('admin')
@section('PageHeader')
<h1>
    Sessions
    <small>Optional description</small>
</h1>
@endsection
@section('content')
<!DOCTYPE html>

<html lang="en">

    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    </head>

    <body>

    <section class="content">
    @include('flash-message')


        @yield('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                   <center> <a href='/session/create' style="margin-top: 10px;" class="btn btn-success">Create Session</a></center>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="session_table"  class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                @hasanyrole('super-admin|city-manager')
                            <th class="text-center">Gym</th>
                            @endhasanyrole
                            @hasrole('super-admin')
                            <th class="text-center">City</th>
                            @endhasrole
                                <th class="text-center">Coach</th>
                                <th class="text-center">starts at</th>
                                <th class="text-center">Ends at</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletepopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Package</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <div>
                        <div id="csrf_value"  hidden >@csrf</div>
                        {{--@method('DELETE')--}}
                        <button type="button" row_delete="" id="delete_item"  class="btn btn-danger" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        <script>

$(function() {

            $('#session_table').DataTable({

                processing: true,

                serverSide: true,
                'paging'      : true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "bLengthChange": true,
                'autoWidth'   : true,


                ajax: '{!! route('get.session') !!}',

                columns: [

                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    @hasanyrole('super-admin|city-manager')
                    { data: 'gym.name', name: 'gym.name' },
                    @endhasanyrole
                    @hasrole('super-admin')
                    {data: 'city.name',name: 'city.name'},
                    @endhasrole
                    { data: 'coach[].name', name: 'coach[].name' },
                    { data: 'starts_at', name: 'starts_at' },
                    { data: 'finishes_at', name: 'finishes_at' },
                    { data: 'session_date', name: 'session_date' },


/* Show */ {
    mRender: function (data, type, row) {
                        return '<center><a href="/session/'+row.id+'" class="table-delete btn btn-info" data-id="' + row.id + '">Show</a></center>'
                    }
                },
                /* EDIT */ {
                    mRender: function (data, type, row) {
                        return '<center><a href="/session/'+row.id+'/edit" class="table-edit btn btn-warning" data-id="' + row.id + '">Edit</a></center>'
                    }
                },

                /* DELETE */ {
                    mRender: function (data, type, row) {
                        return '<center><a href="#" class="table-delete btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#deletepopup" id="delete_toggle">Delete</a></center>'
                    }
                },

            ],
        });

        $(document).on('click','#delete_toggle',function () {
            var delete_id = $(this).attr('row_id');
            $('#delete_item').attr('row_delete',delete_id);
        });

        $(document).on('click','#delete_item',function () {
            var session_id = $(this).attr('row_delete');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/session/'+session_id,
                type: 'DELETE',
                success: function (data) {
                    var table = $('#session_table').DataTable();
                    // table.ajax.reload();
                    window.location.reload();
                },
                error: function (response) {
                    // alert(' Session has attendants');
                    window.location.reload();
                }
            });

        });

    });

        </script>

        @stack('scripts')

    </body>

</html>
    @endsection
