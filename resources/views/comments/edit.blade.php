@extends('layouts.app')

@section('content')
<h2>Edit Comment</h2>

<form method="POST" action="{{ route('comments.update', $comment) }}">
    @csrf
    @method('PUT')

    <input type="text" name="author_name" value="{{ $comment->author_name }}">
    <textarea name="content">{{ $comment->content }}</textarea>

    <button type="submit">Update</button>
</form>
@endsection