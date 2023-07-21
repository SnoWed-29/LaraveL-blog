<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $incomingFlieds = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFlieds['title'] = strip_tags($incomingFlieds['title']);
        $incomingFlieds['body'] = strip_tags($incomingFlieds['body']);
        $incomingFlieds['user_id'] = auth()->id();
        Post::create($incomingFlieds);
        return redirect('/');
    }
    public function showEditScreen(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post',['post'=> $post]);
    }
    public function updatePost(Post $post , Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFlieds = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $incomingFlieds['title'] = strip_tags($incomingFlieds['title']);
        $incomingFlieds['body'] = strip_tags($incomingFlieds['body']);
        $post->update($incomingFlieds);
        return redirect('/');
    }
    public function destroy(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }
}
