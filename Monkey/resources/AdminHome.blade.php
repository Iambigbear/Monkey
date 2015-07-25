@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">后台首页</div>

                <div class="panel-body">

                    <a href="{{ URL('admin/photos/create') }}" class="btn btn-lg btn-primary">新增</a>

                    @foreach ($photos as $photo)
                    <hr>
                    <div class="page">
                        <h4>{{ $photo->photo_name }}</h4>
                        <div class="content">
                            <p>
                                {{ $photo->up_time }}
                            </p>
                            <div class="content">
                                <p>
                                    {{ $page->photo_size }}
                                </p>
                                <div class="content">
                                    <p>
                                        {{ $photo->photo_description }}
                                    </p>
                        </div>
                    </div>
                    <a href="{{ URL('admin/pages/'.$page->id.'/edit') }}" class="btn btn-success">编辑</a>

                    <form action="{{ URL('admin/pages/'.$page->id) }}" method="POST" style="display: inline;">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection