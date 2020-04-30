@extends('welcome')
@section('content')

    <div class="post-preview">
        <a href="#">
            <h2 class="post-title">
                {{($singlepost->title)}}
            </h2>
            <img src="{{URL::to($singlepost->image)}}" alt="" style="height: 100px;width: 400px;">
            <h3 class="post-subtitle">
                {{($singlepost->details)}}
            </h3>
        </a>
        <p class="post-meta">Posted by
            <a href="#">{{($singlepost->author)}}</a>
            {{($singlepost->created_at)}}</p>
    </div>



@endsection