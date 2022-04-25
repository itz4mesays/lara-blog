<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //

    public function index(){
        $posts = Post::select('id','post_title', 'body', 'created_at', 'user_id')
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->cursorPaginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(StorePostRequest $request){

        $request->validated();

        if($request->hasFile('file_name')){
            $imageWithExtension = $request->file('file_name')->getClientOriginalName(); //Filename with extension
            $yourFileName = pathinfo($imageWithExtension, PATHINFO_FILENAME); //extract only the filename without extension
            $extension = $request->file('file_name')->getClientOriginalExtension();
            $fileName = $yourFileName.'_'.time().'.'.$extension; //filename
            $uploadPath = 'public/postUploads';
            $path = $request->file('file_name')->storeAs($uploadPath, $fileName);
        }else{
            $fileName = '';
        }

        $post = new Post();
        $post->post_title = $request->input('post_title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->file_name = $fileName;
        $post->save();

        return redirect()->route('post.all')->with('success', 'Your post has been successfully created!!!');

    }

    public function view(Post $post, $id){
        $post = Post::where('id', $id)->firstOrFail();
        $this->authorize('self-post', $post); 

        return view('posts.view')->with('post',$post);
    }

    public function edit(Post $post, $id){
        $post = Post::where('id', $id)->firstOrFail();
        $this->authorize('self-post', $post);    
        return view('posts.edit')->with('post',$post);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'post_title' => 'required|string:65',
            'body' => 'required',
            'file_name' => 'image|nullable|max:1999'
        ]);


        if($request->hasFile('file_name')  ){
            $imageWithExtension = $request->file('file_name')->getClientOriginalName(); //Filename with extension
            $yourFileName = pathinfo($imageWithExtension, PATHINFO_FILENAME); //extract only the filename without extension
            $extension = $request->file('file_name')->getClientOriginalExtension();
            $fileName = $yourFileName.'_'.time().'.'.$extension; //filename
            $uploadPath = 'public/postUploads';
            $path = $request->file('file_name')->storeAs($uploadPath, $fileName);
        }

        $post = Post::where('id', $id)->firstOrFail();
        $this->authorize('self-post', $post); 

        $oldImage = $post->file_name;

        $post->post_title = $request->input('post_title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->file_name = $fileName ?? $oldImage;
        $post->save();

        return redirect()->route('post.view', $id)->with('success', 'Your post has been successfully updated!!!');
    }

    public function delete($id){
        
        $post = Post::where('id', $id)->firstOrFail();
        $this->authorize('self-post', $post); 

        $post->delete();
        return redirect()->route('post.all')->with('success', 'Post has been deleted!!!');
    }

    protected function getSinglePost($id){
        return Post::where(['id' => $id, 'user_id' => auth()->user()->id])->firstOrFail();
    }
}
