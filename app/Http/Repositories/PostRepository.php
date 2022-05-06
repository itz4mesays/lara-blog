<?php

namespace App\Http\Repositories;

interface PostRepository {
	
	public function create(object $request);

	public function getSinglePost(int $id);

	public function getAllPosts();

	public function updatePost(object $request, int $id);

}