@extends('Super_Admin.Layout.app')

@section('css')

@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Data Menu</h4>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-primary mb-0" href="{{route('menu.create')}}" role="button" style="float: right">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped responsive" id="menu-datatable">
                <thead>
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Url</th>
                    <th scope="col">type</th>
                    <th scope="col">child Menu</th>
                    <th scope="col">Icon</th>
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
    @foreach ($parent as $p)
    <div class="modal fade" id="parentID-{!!$p->id!!}" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Child Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Activation</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($child as $c)
                                    @if ($c->parent_id == $p->id)
                                    <tr>
                                        <td>
                                            <p>{!!$c->name!!}</p>
                                        </td>
                                        <td>
                                            @if ($c->icon == null)
                                            <img src="{{asset('assets/img/icon/no-image.png')}}" class="img-fluid" alt="Responsive image" width="30">
                                            @else
                                            <img src="{{Storage::url('icon/'.$c->icon)}}" class="img-fluid" alt="Responsive image" width="30">
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @if ($c->is_active == 0)
                                            <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="{{route('menu.activation', ['id'=>$c->id, 'data'=>'1'])}}">OFF</a>
                                            @else
                                            <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="{{route('menu.activation', ['id'=>$c->id, 'data'=>'0'])}}">ON</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a style="margin-right: 20px;" href="{{route('menu.edit', ['menu' => $c->id])}}"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                                            
                                            <a style="margin-right: 10px;" href="{{route('menu.delete', ['id' => $c->id])}}"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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

<script>
    $(document).ready(function() {
        $("#menu").addClass("active");
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
        var roletable = $('#menu-datatable').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                "paginate": {
                "previous": "&lt",
                "next": "&gt"
                }
            },
            ajax: "{{ route('menu.serverside') }}",
            order: [
                [1, 'asc']
            ],
            columns: [
                // {data: 'checkbox',name: 'checkbox', searchable: false, orderable: false},
                {data: 'name',name: 'name'},
                {data: 'url',name: 'url'},
                {data: 'type',name: 'type'},
                {data: 'child',name: 'child'},
                {data: 'icon',name: 'icon'},
                {data: 'activation',name: 'activation'},
                {data: 'action',name: 'action'},
            ]
        });
    });
</script>

@endsection