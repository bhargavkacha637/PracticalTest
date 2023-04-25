@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Blogs') }}</h1>
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
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table tableData">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr>
                                    <td><img src="{{url('/')}}/uploads/blogs/{{ $blog->image }}" width="50" height="50"></td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->description }}</td>
                                    <td>{{ $blog->start_date }}</td>
                                    <td>{{ $blog->end_date }}</td>
                                    <td><a href="{{route('blogs.edit',$blog->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="javascript:void(0)" data-id="{{$blog->id}}" class="delete-blog btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        {{ $blogs->links() }}
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete-blog", function() {
            if (confirm("Are u sure?")) {
                $.ajax({
                    url: "{{url('/')}}/blogs/" + $(this).data('id'),
                    method: "DELETE",
                    headers: {
                        "X-CSRF-Token": $("meta[name='csrf-token']").attr("content"),
                    },
                    success: function() {
                        // $(".tableData").load(document.URL + ".tableData");
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection