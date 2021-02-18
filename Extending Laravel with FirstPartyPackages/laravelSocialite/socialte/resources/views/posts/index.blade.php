@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <a href="posts/create" class="brn btn-primary mb-2">Create a new Post</a>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Title</th>
                        <th>Published At</th>
                        <th>Created At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{$post->title}}</td>
                        <td>{{ date('Y-m-d', strtotime($post->published_at)) }}</td>
                        <td>{{ date('Y-m-d', strtotime($post->created_at))}}</td>
                        <td>
                            <form action="posts/{{$post->id}}" method="post" class="d-inline">
                                {{csrf_field()}}
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
