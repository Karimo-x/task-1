<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;
use PHPUnit\Framework\Constraint\FileExists;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PostController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {  
        /* $this->authorize('manageUser',User::class); */
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'images' => 'array'
        ]);
        $rightImages = [];
        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $image) {
                $imageName = $image->getClientOriginalName() . '-' . time() .
                    '.' . $image->getClientOriginalExtension();
                $image->move(public_path("/assets/images"), $imageName);
                $rightImages[] = $imageName;
            }
        }

        Post::create(
            [
                "title" => $request->title,
                "description" => $request->description,
                "images" => json_encode($rightImages)
            ]
        );
        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {   
        $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'images' => 'array'
        ]);
        
        $imgsarray = json_decode($post->images);
        if ($request->hasFile('images')) {
            foreach ($imgsarray as $image) {
                $image_path = public_path("/assets/images/" . $image);

                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $rightImages = [];
            foreach ($request->file('images')  as $image) {
                $imageName = $image->getClientOriginalName() . '-' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/assets/images'), $imageName);
                $rightImages[] = $imageName;
            }
        } else {
            $rightImages[] = $imgsarray;
        }

        $post->update([
            "title" => $request->title,
            "description" => $request->description,
            "images" => json_encode($rightImages)
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('manageUser', User::class); 
        $imgsarray = json_decode($post->images);
        foreach ($imgsarray as $image) {
            $image_path = public_path("/assets/images/" . $image);

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        } 
        $post->delete();
        return redirect()->route('posts.index');
    }
}
