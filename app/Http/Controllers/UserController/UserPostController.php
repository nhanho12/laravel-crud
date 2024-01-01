<?php

namespace App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Redis;
use App\Jobs\ProcessSendEmail;
use App\Mail\MailPostCreated;
use App\Mail\PostCreated;
use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;

class UserPostController extends Controller
{
    public function getAllPostData()
    {
        $posts = Post::with('author')->get();
        FacadesSession::put('posts', $posts);
        return view('user.user-post', ['posts' => $posts]);
    }

    public function createPost(Request $request)
    {
        $data = $request->all();
        try {
            if (!empty($data)) {
                $post = new Post();
                $post->title = $data['title'];
                $post->content = $data['content'];
                $post->tags = $data['tag'];
                $post->published_date = Carbon::now();

                // handle image
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);
                    $imageUrl = 'images/' . $imageName;
                    $post->image = $imageUrl;
                }

                //get userId from session for author
                $userId = session('user')->id;
                if ($userId) {
                    $post->author_id = $userId;
                } else {
                    $post->author_id = null;
                }
                $post->save();

                //send email to admin if post created successfully
                ProcessSendEmail::dispatch('hodanhnhan1166@gmail.com');
                
                return redirect('/user')->with('message', 'Post has been created!');
            }
        } catch (Exception $e) {
            var_dump($e);
            return redirect()->back()->withErrors(['message' => 'Error, try again!'])->withInput()->with('exception', $e);
        }
    }

    public function deletePost($id)
    {
        try {
            $post = Post::findOrFail($id);
            // remove image if post is deleted
            if ($post->image) {
                $imagePath = public_path($post->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $post->delete();

            return redirect('/user')->with('message', 'Post has been deleted!');
        } catch (Exception $e) {
            var_dump($e);
            return redirect()->back()->withErrors(['message' => 'Error deleting post.'])->with('exception', $e);
        }
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.admin-post', ['post' => $post]);
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tag');

        // handle image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imageUrl = 'images/' . $imageName;
            $post->image = $imageUrl;
        }

        $post->save();

        return redirect('/admin')->with('message', 'Post has been updated!');
    }
}
