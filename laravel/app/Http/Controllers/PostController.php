<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
class PostController extends Controller
{

public function __construct()
{
        $this->middleware('auth');
}


public function store(Request $request)
{		
		//Data Validation
    	$validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'description' => 'required',
        'tag' => 'required',
        'author' => 'required|min:4|max:40',
    ]);

    $post= new Post;
    $post->title = $request->title;
    $post->author = $request->author;
    $post->tag = $request->tag;
    $post->description = $request->description;

    $post->save();

    if ($post->save()) {
    	$notification = array(
    'message' => 'Post Added Successfully!',
    'alert-type' => 'success'
	);
		return Redirect()->back()->with($notification, 'Post Added Successfully!');
    }
    else{
    	return Redirect()->back;
    }
}


public function AllPost()
{
    	$post=Post::all();
    	return view('all_post')->with('post',$post);

    	// Post Preview
    	//echo "<pre>";
    	//print_r($post);
    	//exit();

    	// if order by dese 
    	// $post=Post::orderBy('id','DESC')->get();
}


public function Delete($id)
{

    $post = Post::find($id);
    $delete=$post->delete();

    if ($delete) {
    	$notification = array(
    'message' => 'Post Delete Successfully!',
    'alert-type' => 'error'
	);
		return Redirect()->back()->with($notification, 'Post Delete Successfully!');
    }
    else{
    	return redirect('/home');
    }

	//Preview
	//$post = Post::find($id);
	//return $post;
}


public function Edit($id)
{
	$post = Post::findorfail($id);
	return view('editpost',compact('post'));
}

public function Update(Request $request, $id)
{
	//Data Validation
    	$validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'tag' => 'required',
        'author' => 'required|min:4|max:40',
    ]);
    	$post = Post::findorfail($id);
    	$post->title = $request->title;
    	$post->author = $request->author;
    	$post->tag = $request->tag;
    	$post->description = $request->description;
    	$update=$post->save();

    if ($update) {
    	$notification = array(
    'message' => 'Post Update Successfully!',
    'alert-type' => 'info'
	);
		return Redirect()->route('home')->with($notification, 'Post Update Successfully!');
    }
    else{
    	return Redirect()->back;
    }
}


    public function News()
    {
        return view('news_add');
    }




    public function insertnews(Request $request)
    {
         $validatedData = $request->validate([
             'title' => 'required',
             'details' => 'required',
             'image' => ' mimes:jpeg,jpg,png,PNG | max:1000',
             'author' => 'required|min:4|max:40',
         ]);

        $data=array();
        $data['title']=$request->title;
        $data['author']=$request->author;
        $data['details']=$request->details;
        $image=$request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/post/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('newss')->insert($data);
             $notification = array(
            'message' => 'Post Added Successfully!',
            'alert-type' => 'info'
            );
                return Redirect()->route('home')->with($notification, 'Post Added Successfully!');
            }
            else{
                return Redirect()->back;
            }

    }

    public function AllNews()
    {
        $news=DB::table('newss')->get();
        return view('all_news', compact('news'));
    }


    public function DeleteNews($id)
    {
        $img=DB::table('newss')->WHERE('id',$id)->first();
        $image_path=$img->image;
        $done=unlink($image_path);
        $delete=DB::table('newss')->WHERE('id',$id)->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Post Delete Successfully!',
                'alert-type' => 'error'
            );
            return Redirect()->route('all.news')->with($notification, 'Post Delete Successfully!');
        }
        else{
            return redirect()->back();
        }

    }


}
