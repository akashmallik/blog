@extends('layouts.backend.app')


@push('css')
  <!-- Bootstrap Select Css -->
  <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">BACK</a>
    @if ($post->is_approved == false)
        <button class="btn btn-success pull-right waves-effect" type="button" onclick="approvePost(),{{ $post->id}}">
            <i class="material-icons">done</i>
            <span>Approve</span>
        </button>
        <form action="{{ route('admin.post.approve',$post->id)}}" method="POST" id="approval-form" style="display:none;">
            @csrf
            @method('PUT')
        </form>
    @else
        <button class="btn btn-success pull-right" type="button" disabled>
            <i class="material-icons">done</i>
            <span>Approved</span>
        </button>
    @endif

    <br>
    <br>


    <div class="row clearfix">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $post->title }}
                        <small>Posted By <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->toFormattedDateString() }}</small>
                    </h2>
                </div>
                <div class="body">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->categories as $category)
                        <span class="label bg-cyan">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->tags as $tag)
                        <span class="label bg-green">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        Featured Image
                    </h2>
                </div>
                <div class="body">
                    <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- TinyMCE -->
<script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.6/dist/sweetalert2.all.min.js"></script>
<!-- Custom Js -->
<script>
    //TinyMCE
    $(function () {
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
    //sweetalert
    function approvePost(id){
     const swalWithBootstrapButtons = Swal.mixin({
       confirmButtonClass: 'btn btn-success',
       cancelButtonClass: 'btn btn-danger',
       buttonsStyling: false,
     })

     swalWithBootstrapButtons.fire({
       title: 'Are you sure?',
       text: "You want to approve this post!",
       type: 'warning',
       showCancelButton: true,
       confirmButtonText: 'Yes, approve it!',
       cancelButtonText: 'No, cancel!',
       reverseButtons: true
     }).then((result) => {
       if (result.value) {
         event.preventDefault();
         document.getElementById('approval-form').submit();
       } else if (
         // Read more about handling dismissals
         result.dismiss === Swal.DismissReason.cancel
       ) {
         swalWithBootstrapButtons.fire(
           'Cancelled',
           'The post remains pending :)',
           'info'
         )
       }
     })
   }
</script>
@endpush
