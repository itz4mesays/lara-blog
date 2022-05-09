<?php

namespace App\Http\Services;

use App\Http\Repositories\PostRepository;
use App\Models\Comments;
use App\Models\Likes;
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

    public function likePost(object $request)
    {
        $newLike = new Likes();
        $newLike->post_id = $request->post_id;
        $newLike->likes = $request->type == 'like' ? $request->countNum : 0;
        $newLike->unlikes = $request->type == 'unlike' ? $request->countNum : 0;
        return $newLike->save();
    }

    public function addComment(object $request): array
    {
        try {
            //code...
            $comment = new Comments();
            $comment->post_id = $request->pid;
            $comment->message = $request->message;
            $comment->save();

            return [
                'code' => 201,
                'id' => $comment->id,
                'username' => $comment->author->name,
                'date_created' => date('d F, Y', strtotime($comment->created_at)),
                'message' => $request->message,
                'msg' => 'Comment has been added successfully'
            ];
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'code' => 500,
                'message' => $th->__toString()
            ];
        }
        
    }
}
