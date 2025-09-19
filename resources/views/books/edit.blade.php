@extends('books.layout')

@section('content')
    <h2>Edit Book</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('books.form', ['book' => $book])
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
@endsection
