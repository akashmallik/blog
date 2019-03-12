@extends('layouts.backend.app')


@push('css')
  <!-- JQuery DataTable Css -->
  <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">   
@endpush

@section('content')
<div class="container-fluid">
  <div class="block-header">
      <a href="{{ route('admin.post.create') }}" class="btn btn-primary waves-effect"><i class="material-icons">add</i> <span>ADD POST</span></a>
  </div>
  <!-- Exportable Table -->
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      POST LIST <span class="badge bg-blue">{{ $posts->count() }}</span>
                  </h2>
                  <ul class="header-dropdown m-r--5">
                      <li class="dropdown">
                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">more_vert</i>
                          </a>
                      </li>
                  </ul>
              </div>
              <div class="body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Title</th>
                                  <th>Author</th>
                                  <th>View Count</th>
                                  <th>Is Approved</th>
                                  <th>Status</th>
                                  <th>Created At</th>
                                  <th>Updated At</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($posts as $key=>$post)
                                <tr>
                                  <td>{{ $key+1 }}</td>
                                  <td>{{ str_limit($post->title, 12) }}</td>
                                  <td>{{ $post->user->name }}</td>
                                  <td>{{ $post->view_count }}</td>
                                  <td>
                                    @if ($post->is_approved == true)
                                      <span class="badge bg-blue">Approved</span>
                                    @else
                                      <span class="badge">Pending</span>
                                    @endif
                                  </td>
                                  <td>
                                      @if ($post->status == true)
                                        <span class="badge bg-blue">Published</span>
                                      @else
                                        <span class="badge">Pending</span>
                                      @endif
                                  </td>
                                  <td>{{ $post->created_at }}</td>
                                  <td>{{ $post->updated_at }}</td>
                                  <td class="text-center">
                                      <a href="{{ route('admin.post.edit', $post->id ) }}" class="btn btn-info btn-sm waves-effect">
                                          <i class="material-icons">edit</i>
                                      </a>
                                      <button class="btn btn-danger" onclick="deletePost({{ $post->id }})">
                                          <i class="material-icons">delete</i>
                                      </button>
                                      <form id="delete-form-{{ $post->id }}" action="{{ route('admin.category.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                      </form>
                                  </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- #END# Exportable Table -->
</div>

@endsection

@push('js')
  <!-- Jquery DataTable Plugin Js -->
  <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
  <!-- Custom Js -->
  <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.6/dist/sweetalert2.all.min.js"></script>
  <script>
    function deletePost(id){
      const swalWithBootstrapButtons = Swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          event.preventDefault();
          document.getElementById('delete-form-'+id).submit();
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your Data is safe :)',
            'error'
          )
        }
      })
    }
  </script>
@endpush
