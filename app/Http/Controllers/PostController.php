<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;
use PHPUnit\Framework\Constraint\FileExists;

use function Pest\Laravel\delete;

class PostController extends Controller
{
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
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $imgsarray = json_decode($post->images);

        if ($request->hasFile('images')) {
            foreach ($imgsarray as $image) {
               /*  $pathImage = public_path('/assets/images/' . $image);
                if (File::exists($pathImage)) {
                    File::delete($pathImage);
                } */

                $image_path = public_path("/assets/images/" . $image);

                if (file_exists($image_path)) {

                    unlink($image_path);
                }

                /* if(file_exists($pathImage)){
                    unlink($pathImage);
                    delete($pathImage);
                    
                } */
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
        $post->delete();
        return redirect()->route('posts.index');
    }
}
