<?php

namespace App\Http\Controllers;


// use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Policies\PostPolicy;

class PostController extends Controller
{
    public function index() { 
    //On récupère tous les Post
    $posts = Post::with('user')->latest()->get();

    // On transmet les Post à la vue
    return view("posts.index", compact("posts"));
    return view("/", compact("posts"));
    }
    

    public function create() { 
        return view("posts.create");
    }

    public function store(Request $request) { 
    // 1. La validation
    $this->validate($request, [
        'title' => 'bail|required|string|max:255',
        "picture" => 'bail|required|image|max:1024',
        "content" => 'bail|required',
    ]);

    // 2. On upload l'image dans "/storage/app/public/posts"
    $chemin_image = $request->picture->store("posts");

    // 3. On enregistre les informations du Post
    Post::create([
        "title" => $request->title,
        "picture" => $chemin_image,
        "content" => $request->content,
    ]);

    // 4. On retourne vers tous les posts : route("posts.index")
    return redirect(route("posts.index"));
    }

    public function show(Post $post) {
        // $comments = Comment::with('user','post')->latest()->get();

        return view("posts.show", compact("post"));
     }

    public function edit(Post $post) { 
        $this->authorize('update', $post);

        return view("posts.edit", compact("post"));
    }

    public function update(Request $request, Post $post) { 
        $this->authorize('update', $post);

        // 1. La validation

    // Les règles de validation pour "title" et "content"
    $rules = [
        'title' => 'bail|required|string|max:255',
        "content" => 'bail|required',
    ];

    // Si une nouvelle image est envoyée
    if ($request->has("picture")) {
        // On ajoute la règle de validation pour "picture"
        $rules["picture"] = 'bail|required|image|max:1024';
    }

    $this->validate($request, $rules);

    // 2. On upload l'image dans "/storage/app/public/posts"
    if ($request->has("picture")) {

        //On supprime l'ancienne image
        Storage::delete($post->picture);

        $chemin_image = $request->picture->store("posts");
    }

    // 3. On met à jour les informations du Post
    $post->update([
        "title" => $request->title,
        "picture" => isset($chemin_image) ? $chemin_image : $post->picture,
        "content" => $request->content
    ]);

    // 4. On affiche le Post modifié : route("posts.show")
    return redirect(route("posts.show", $post));
    }

    public function destroy(Post $post) { 
        $this->authorize('delete', $post);
    // On supprime l'image existant
    Storage::delete($post->picture);

    // On les informations du $post de la table "posts"
    $post->delete();

    // Redirection route "posts.index"
    return redirect(route('posts.index'));

    }
}
