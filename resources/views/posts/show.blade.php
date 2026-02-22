@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary">
                    &larr; Back to Posts
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $post->title }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <small>
                                By <strong>{{ $post->user->name }}</strong> | 
                                {{ $post->created_at->format('F j, Y \a\t g:i a') }}
                                @if($post->created_at != $post->updated_at)
                                    <span class="ms-2">(Updated: {{ $post->updated_at->format('M d, Y') }})</span>
                                @endif
                            </small>
                        </div>
                        @can('update', $post)
                            <div>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <div class="card-text">
                        {!! nl2br(e($post->description)) !!}
                    </div>
                    <h3>Comments</h3>

                    <hr class="my-4">

<h3 class="mb-3">Comments</h3>

@forelse($post->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <strong>{{ $comment->author_name }}</strong>
                <div>
                    <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Delete this comment?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <p class="mt-2 mb-0">{{ $comment->content }}</p>
        </div>
    </div>
@empty
    <p class="text-muted">No comments yet.</p>
@endforelse


<hr class="my-4">

<h4 class="mb-3">Add Comment</h4>

<form method="POST" action="{{ route('comments.store') }}">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <div class="mb-3">
        <input type="text" name="author_name" class="form-control" placeholder="Your Name" required>
    </div>

    <div class="mb-3">
        <textarea name="content" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit Comment</button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
