@extends('layouts.backend.app')


@push('css')
  <!-- JQuery DataTable Css -->
  <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">   
@endpush

@section('content')
<div class="container-fluid">
  <!-- Vertical Layout | With Floating Label -->
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      ADD TAG
                  </h2>
              </div>
              <div class="body">
                  <form action="{{ route('admin.tag.store') }}" method="POST">
                    @csrf
                      <div class="form-group form-float">
                          <div class="form-line">
                              <input type="text" id="name" class="form-control" name="name">
                              <label class="form-label">Name</label>
                          </div>
                      </div>
                      <a href="{{ route('admin.tag.index') }}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
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
  <script src="{{ asset('backend/js/admin.js') }}"></script>
  <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>
@endpush
