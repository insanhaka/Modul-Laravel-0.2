@extends('Backend.Layout.app')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Artikel</h4>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-primary mb-0" href="{{route('konten-artikel.create')}}" role="button" style="float: right">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped responsive" id="konten-artikel-datatable">
                <thead>
                  <tr>
                    <th scope="col">Judul</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Activation</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    {{-- Serverside Handle --}}

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
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
        var art = $('#konten-artikel-datatable').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "paginate": {
                "previous": "&lt",
                "next": "&gt"
                }
            },
            ajax: "{{ route('konten-artikel.serverside') }}",
            order: [
                [1, 'asc']
            ],
            columns: [
                // {data: 'checkbox',name: 'checkbox', searchable: false, orderable: false},
                {data: 'title',name: 'title'},
                {data: 'thumbnail',name: 'thumbnail'},
                {data: 'activation',name: 'activation'},
                {data: 'action',name: 'action'},
            ]
        });
    });
</script>
@endsection
      
  