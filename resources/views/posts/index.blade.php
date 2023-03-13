@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-10 mt-3">
            <h2 class="titre">Blog</h2>
        </div>

        <div class="col-lg-2 mt-3">
            <a class="btn btn-success" href="{{ url('posts/create') }}">Ajouter un posts</a>
        </div>

    </div>

<hr>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>

    @endif



<div class="container mt-3">
    <div class="row">
        @foreach ($posts as $index => $posts)
        <div class="col-md-4">
            <div class="card card-body">
                <a href="{{ url('posts/'. $posts->id) }}">
                <h2>
                        {{ $posts->title }}
                    </h2>
                </a>
            <p>Ecrit par: {{ Auth::user()->name }}| date: {{ $posts->created_at }}</p>
            <a href="{{ url('posts/'. $posts->id) }}" class="btn btn-outline-primary">En savoir plus</a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection