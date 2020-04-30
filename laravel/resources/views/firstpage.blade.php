@extends('welcome')
@section('content')
    @php
        $post=DB::table('newss')->get();
    @endphp
    @foreach($post as $row)
        <div class="post-preview">
            <a href="{{URL::to('view-post/'.$row->id)}}">
                <h2 class="post-title">
                    {{($row->title)}}
                </h2>
                <img src="{{URL::to($row->image)}}" alt="" style="width: 300px; height: 300px;">
                <h3 class="post-subtitle">
                    {{($row->details)}}
                </h3>
            </a>
            <p class="post-meta">Posted by
                <a href="#">{{($row->author)}}</a>
                {{($row->created_at)}}</p>
        </div>
        <hr>
    @endforeach
    <!-- Pager -->
    <div class="clearfix">
        <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
    </div>
    </div>
@endsection