<?php

namespace App\Http\Services;

use App\Http\Repositories\PostRepository;
use App\Models\Post;

class PostService implements PostRepository 
{
	public function getSinglePost(int $id)
	{
		return Post::where(['id' => $id])->firstOrFail();
	}

	public function create(object $data)
	{
		if($data->hasFile('file_name')){
            $imageWithExtension = $data->file('file_name')->getClientOriginalName(); //Filename with extension
            $yourFileName = pathinfo($imageWithExtension, PATHINFO_FILENAME); //extract only the filename without extension
            $extension = $data->file('file_name')->getClientOriginalExtension();
            $fileName = $yourFileName.'_'.time().'.'.$extension; //filename
            $uploadPath = 'public/postUploads';
            $path = $data->file('file_name')->storeAs($uploadPath, $fileName);
        }else{
            $fileName = '';
        }

        $post = new Post();
        $post->post_title = $data->input('post_title');
        $post->body = $data->input('body');
        $post->user_id = auth()->user()->id;
        $post->file_name = $fileName;
        $post->save();
	}

	public function getAllPosts()
	{
		return Post::select('id','post_title', 'body', 'created_at', 'user_id')
				->where('user_id', auth()->user()->id)
				->orderBy('created_at', 'desc')
				->cursorPaginate(10);
	}

	public function updatePost(object $request, int $id)
	{
		
		$post = $this->getSinglePost($id);

		if($request->hasFile('file_name')  ){
            $imageWithExtension = $request->file('file_name')->getClientOriginalName(); //Filename with extension
            $yourFileName = pathinfo($imageWithExtension, PATHINFO_FILENAME); //extract only the filename without extension
            $extension = $request->file('file_name')->getClientOriginalExtension();
            $fileName = $yourFileName.'_'.time().'.'.$extension; //filename
            $uploadPath = 'public/postUploads';
            $path = $request->file('file_name')->storeAs($uploadPath, $fileName);
        }

        $oldImage = $post->file_name;

        $post->post_title = $request->input('post_title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->file_name = $fileName ?? $oldImage;
        $post->save();
	}
}
