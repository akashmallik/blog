@extends('layouts.backend.app')


@push('css')
  <!-- JQuery DataTable Css -->
  <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">   
@endpush

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD POST
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="title" class="form-control" name="title">
                                <label class="form-label">Post Title</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">Featured Image</label>
                            <div class="form-line">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                        <input type="checkbox" id="publish" class="filled-in">
                        <label for="publish">Publish</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categories & Tags
                        </h2>
                    </div>
                    <div class="body">
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
                        <a href="{{ route('admin.post.index') }}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Body
                        </h2>
                    </div>
                    <div class="body">
                        <textarea name="body" id="tinymce"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('js')
<!-- TinyMCE -->
<script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
<!-- Custom Js -->
{{-- <script src="{{ asset('backend/js/pages/forms/editors.js') }}"></script> --}}
<script>
    $(function () {
        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '{{ asset("backend/plugins/tinymce") }}';
    });
</script>
@endpush
