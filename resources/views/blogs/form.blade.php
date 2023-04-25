@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if(isset($blog))
                <h1 class="m-0">{{ __('Edit Blog') }}</h1>
                @else
                <h1 class="m-0">{{ __('Create Blog') }}</h1>
                @endif
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if(\Session::has('success'))
                <div class="alert alert-succes">
                    {!! \Session::get('success') !!}
                </div>
                @endif
                @if(\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
                @endif
                <form id="blogForm" method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" @if(isset($blog)) value="{{$blog->id}}" @else value="" @endif name="edit_id">
                    <label>Title</label>
                    <div class="input-group mb-3">
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="{{ __('Title') }}" @if(isset($blog)) value="{{$blog->title}}" @else value="{{old('title')}}" @endif autocomplete="title" autofocus>
                        @error('title')
                        <span class="error invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <label>Description</label>
                    <div class="input-group mb-3">
                        <textarea type="text" rows="4" cols="50" id="description" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus>
                        @if(isset($blog)) {{$blog->description}} @else {{old('description')}} @endif    
                    </textarea>
                        @error('description')
                        <span class="error invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <label>Start Date</label>
                    <div class="input-group mb-3">
                        <input type="date" id="start_date" @if(isset($blog)) value="{{$blog->start_date}}" @else value="{{old('start_date')}}" @endif name="start_date" class="form-control @error('start_date') is-invalid @enderror" autocomplete="start_date" autofocus>
                        @error('start_date')
                        <span class="error invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <label>End Date</label>
                    <div class="input-group mb-3">
                        <input type="date" name="end_date" id="end_date" @if(isset($blog)) value="{{$blog->end_date}}" @else value="{{old('end_date')}}" @endif class="form-control @error('end_date') is-invalid @enderror" autocomplete="end_date" autofocus>
                        @error('end_date')
                        <span class="error invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <label>Is Active ?</label>
                    <div class="input-group mb-3">
                        <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>

                        @error('is_active')
                        <span class="error invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <label>Image</label>

                    <div class="input-group mb-3">
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="{{ __('Image') }}" autocomplete="image" autofocus>
                        @error('image')
                        <span class="error invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input class="btn btn-primary btn-block" type="submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $("#blogForm").validate({
        rules: {
            title: "required",
            description: {
                required: true,
                minlength: 5,
                maxlength: 30,
            },

            start_date: {
                required: true,
                date: true
            },
            end_date: {
                required: true,
                date: true,
            },
            image: "required",
        },
        messages: {
            title: "Please enter title",
            description: {
                required: "Please enter description",
                minlength: "Please enter 5 characters",
                maxlength: "Please enter max 30 characters ",
            },
            start_date: {
                required: "Please select start date",
                date: "Please enter valid start date"
            },
            end_date: {
                required: "Please select end date",
                date: "Please enter valid end date",
            },
            image: "Please select image",
        }
    })
</script>
@endsection