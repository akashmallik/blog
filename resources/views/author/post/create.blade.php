@extends('layouts.backend.app')


@push('css')
  <!-- Bootstrap Select Css -->
  <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <form action="{{ route('author.post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD NEW POST
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
                        <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
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
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : ''}}">
                                <label for="category">Category</label>
                                <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : ''}}">
                                <label for="tag">Tag</label>
                                <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{ route('author.post.index') }}" class="btn btn-primary m-t-15 waves-effect">BACK</a>
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
