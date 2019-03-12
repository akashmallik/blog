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
                      ADD CATEGORY
                  </h2>
              </div>
              <div class="body">
                  <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group form-float">
                          <div class="form-line">
                              <input type="text" id="name" class="form-control" name="name">
                              <label class="form-label">Name</label>
                          </div>
                      </div>
                      <div class="form-group form-float">
                          <div class="form-line">
                              <input type="file" class="form-control" name="image">
                          </div>
                      </div>
                      <a href="{{ route('admin.category.index') }}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

@push('js')
@endpush
