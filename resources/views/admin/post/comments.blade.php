@extends('layouts.backend.app')


@push('css')
  <!-- JQuery DataTable Css -->
  <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">   
@endpush

@section('content')
<div class="container-fluid">
  <!-- Exportable Table -->
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      All COMMENTS <span class="badge bg-blue">{{ $comments->count() }}</span>
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
                                  <th>Comments Info</th>
                                  <th>Post Info</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($comments as $comment)
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="">
                                        <img src="{{ Storage::disk('public')->url('Profile/').$comment->user->image }}" alt="" width="40" height="40">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                      <p>{!! $comment->comment !!}</p>
                                      <a target="_blank" href="{{ route('post.details',$comment->post->slug.'#comments') }}">Reply</a>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="media">
                                    <div class="media-left">
                                      <a href="">
                                        <img src="{{ Storage::disk('public')->url('post/').$comment->post->image }}" alt="" width="40" height="40">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">
                                        <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">{{ $comment->post->title }}</a>
                                        <small>{{ $comment->post->created_at->diffForHumans() }}</small>
                                      </h4>
                                      <p>{!! $comment->post->body !!}</p>
                                    </div>
                                  </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger" onclick="removeComment({{ $comment->id }})">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <form id="remove-form-{{ $comment->id }}" action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST">
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
    function removeComment(id){
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
          document.getElementById('remove-form-'+id).submit();
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
