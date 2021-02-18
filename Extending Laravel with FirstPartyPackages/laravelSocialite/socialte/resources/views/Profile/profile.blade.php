@extends('layout.app')
@section('title')
{{$user->name}}
@endsection
@section('content')
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                Joined on {{$user->created_at->format('M d, Y \a\t h:i a')}}
            </li>
            <li class="list-group-item panel-body">
                <table>

                    <tr>
                        <td>Total Posts</td>
                        <td>{{ $posts_count }}</td>
                        @if($author && $post_count)
                        <td><a href="{{ url('/my-all-posts')}}">Show all</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Published Posts</td>
                        <td>{{ $posts_active_count }}</td>
                        @if($author && $post_count)
                        <td><a href="{{ url('/user/'.$user->id.'/posts')}}">Show all</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Posts in draft</td>
                        <td>{{ $posts_draft_count }}</td>
                        @if($author && $posts_draft_count)
                        <td><a href="{{ url('my_drafts')}}">Show all</a></td>
                        @endif
                    </tr>
                </table>
            </li>
            <li class="list-group-item">
                Total Comments {{$comments_count}}
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Latest Posts</h3>
        </div>
        <div class="panel-body">
            @if(!empty($latest_posts[0]))
                @foreach($latest_posts as $latest_posts)
                    <p>
                        <strong><a href="{{url('/'.$latest_post)}}">{{ $latest_post->title }}</a></strong>
                        <span class="well-sm">On {{ $latest_post->created_at->format('d-M-Y \a\t h:i a')}}</span>
                    </p>
                @endforeach
            @else
                <p>You have not written any posts till now.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest comments</h3></div>
        <div class="list-group">
            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comments)
                    <div class="list-group-item">
                        <p>{{$latest_comments->body }}</p>

                    </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>You have not commented till now, your latest 5 comments will be displayed here</p>
                </div>
            @endif
        </div>
    </div>

@endsection
