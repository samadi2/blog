@extends("layouts.app")
@section("title", $post->title)
@section("content")


	<h1 class="ici">{{ $post->title }}</h1>

	<img src="{{ asset('storage/'.$post->picture) }}" alt="Image de couverture" style="max-width: 300px;"  class="image">

    <div class="para">{{ $post->content }}</div>
    <hr>
    <h5>Commentaires</h5>
    @forelse ($post->comments as $comment)
    <div class="card">
        <div class="card-body">
            <span>Ecrit par :{{ Auth::user()->name }}</span>|
            <small>{{ $comment->created_at->format('j M Y, g:i a') }}</small><br><hr>
           <p class="par">{{ $comment->content}}</p> 
        </div>
    </div>
    @empty
    <div class="alert alert-info">Aucun commentaire pour cet article</div>
    @endforelse
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex flex-col  rounded-lg p-4">
    @csrf
        <div class="form-group mb-3">
            <label for="content">Votre commentaire</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Soumettre mon commentaire</button>
    </form>     
    <div class="buttons mt-3 btn">
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-info">Modifier</a>
        <form action="{{ url('posts/'. $post->id) }}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        <p><a href="{{ route('posts.index') }}" title="Retourner aux articles"  class="btn btn-info mt-2">Retourner aux posts</a></p>
    </div>


	

@endsection

            
