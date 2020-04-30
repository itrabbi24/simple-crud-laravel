@extends('layouts.app')
@section('content')

    <div class="container">
        <a href="{{(route('all.news'))}}" class="btn btn-success">All News</a>
        <form action="{{ url('/insert-news') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title"
                           name="title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Author</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Author"
                           name="author">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Image</label>
                    <input type="file" class="form-control" id="exampleFormControlInput1" name="image">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>

@endsection
