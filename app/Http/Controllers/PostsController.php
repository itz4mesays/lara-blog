<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Services\PostService;
use App\Models\Likes;
use App\Models\TrackLikes;
use Illuminate\Http\Exceptions\HttpResponseException;
use Validator;

class PostsController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(){
        $this->authorize('view-my-posts');
        $posts = $this->postService->getAllPosts();
        return view('posts.index')->with('posts', $posts);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(StorePostRequest $request){

        $request->validated();

        $this->postService->create($request);

        return redirect()->route('user.post.all')->with('success', 'Your post has been successfully created!!!');

    }

    public function view(Post $post, $id){

        $post = $this->postService->getSinglePost($id);
        $this->authorize('self-post', $post);

        return view('posts.view')->with('post',$post);
    }

    public function edit(Post $post, $id){
        $post = $this->postService->getSinglePost($id);

        $this->authorize('self-post', $post);
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update a single post
     */
    public function update(Request $request, $id){

        $this->validate($request, [
            'post_title' => 'required|string:65',
            'body' => 'required',
            'file_name' => 'image|nullable|max:1999'
        ]);

        $this->authorize('self-post', $this->postService->getSinglePost($id));

        $this->postService->updatePost($request, $id);

        return redirect()->route('user.post.view', $id)->with('success', 'Your post has been successfully updated!!!');
    }

    public function delete($id){

        $post = $this->postService->getSinglePost($id);
        $this->authorize('self-post', $post);

        $post->delete();
        return redirect()->route('user.post.all')->with('success', 'Post has been deleted!!!');
    }

    public function likePost(Request $request){

        $response = [];

        $rules= [
            'post_id'  =>"required|integer",
            'type' =>"required|string",
            'countNum' =>"required|integer",
        ];

        $validator= Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            $response['status'] = 400;
            $response['data'] = $validator->errors();
        }else{
            //Get a single Like Record for a post
            $post = $this->postService->getSingleLike($request->post_id);
                     
            $type = $request->type == 'like' ? 'like' : 'unlike';    

            if(!$post){
                try {
                    \DB::beginTransaction();

                    $this->postService->likePost($request); //save into likes table

                    $track_likes = new TrackLikes();
                    $track_likes->post_id = $request->post_id;
                    $track_likes->type = $type;
                    $track_likes->save();
                 
                    \DB::commit();
                    
                    $response['status'] = 201;
                    $response['data'] = 'You have successfully '. $request->type.'d this post';
                } catch (\Throwable $th) {
                    \DB::rollback();
                    $response['status'] = 500;
                    $response['data'] = $th->__toString();
                }
            }else{
                //Check the track_likes table if user has liked or unliked this post before
                $postLike = TrackLikes::where(['user_id' => auth()->user()->id, 'post_id' => $request->post_id, 'type' => $type])->first();
                try {
                    if($postLike){
                        $liketype = $postLike == 'like' ? 'liked' : 'unliked';
                        $response['status'] = 422;
                        $response['data'] = 'You have already '.$liketype.' this post before';
                    }else{
                        try {
                            \DB::beginTransaction();

                            $post->likes = ($request->type == 'like') ? $request->countNum : $post->likes;
                            $post->unlikes = ($request->type == 'unlike') ? $request->countNum : $post->unlikes;
                            $post->save();

                            \DB::commit();

                            $response['status'] = 201;
                            $response['data'] = 'You have successfully '. $request->type.'d this post';
                        } catch (\Throwable $th) {
                            //throw $th;
                            \DB::rollback();
                            $response['status'] = 500;
                            $response['data'] = $th->__toString();
                        }


                    }

                } catch (\Throwable $th) {
                    $response['status'] = 500;
                    $response['data'] = $th->__toString();
                }

            }
        }

        return response()->json($response);
    }

    /**
     * Add Comment to a single post
     * return json
     */
    public function addComment(Request $request){
        $result = $this->postService->addComment($request);
        return response()->json($result);
    }

    /**
     * Add Sub Comment Under a Comment
     * @param Request $request
     * @return void
     */
    public function addChildComment(Request $request){
        $result = $this->postService->addSubComment(($request));
        return response()->json($result);
    }

    protected function getSinglePost($id){
        return Post::where(['id' => $id, 'user_id' => auth()->user()->id])->first();
    }
}
