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
                    <th scope="col">Lihat</th>
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

    <!-- Modal -->
    @foreach ($content as $value)
    <div class="modal fade" id="parentID-{!!$value->id!!}" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="badge rounded-pill bg-label-primary">
                        Preview
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <h1 class="text-center">{!! $value->title !!}</h1>
                            <hr/>
                            <br/>
                            {!! $value->content !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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
                {data: 'view',name: 'view'},
                {data: 'activation',name: 'activation'},
                {data: 'action',name: 'action'},
            ]
        });
    });
</script>
@endsection
      
  