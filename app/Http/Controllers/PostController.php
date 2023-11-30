<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function storeNewPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        // Remove any HTML that is suspicious
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        // this will grab the ID of the user logged in
        $incomingFields['user_id'] = auth()->id();
        // Communicate with the Post Model to send to mySQL
        // Change this message later to actually display something useful later
        Post::create($incomingFields);
        return 'Thank you for your post!';
    }

    public function showCreateForm() {
        return view('create-post');
    }
}
