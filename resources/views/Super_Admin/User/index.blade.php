@extends('Super_Admin.Layout.app')

@section('css')

@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Data User</h4>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-info mb-0" href="{{route('user.create')}}" role="button" style="float: right">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped responsive" id="user-datatable">
                <thead>
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Activation</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    {{-- Server-side Handle --}}

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    $(document).ready(function() {
        $("#user").addClass("active");
    });
</script>

<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    @if ($message = Session::get('success'))
        Toast.fire({
            icon: 'success',
            title: '{{$message}}'
        })
    @endif
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var usertable = $('#user-datatable').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            "language": {
                "paginate": {
                "previous": "&lt",
                "next": "&gt"
                }
            },
            ajax: "{{ route('user.serverside') }}",
            order: [
                [1, 'asc']
            ],
            columns: [
                {data: 'name',name: 'name'},
                {data: 'username',name: 'username'},
                {data: 'email',name: 'email'},
                {data: 'role',name: 'role'},
                {data: 'active',name: 'active'},
                {data: 'action',name: 'action'},
            ]
        });
    });
</script>

@endsection

