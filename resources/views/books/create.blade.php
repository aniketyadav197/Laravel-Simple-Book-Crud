@extends('books.layout')

@section('content')
    <h2>Add New Book</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        @include('books.form')
        <button type="submit" class="btn btn-success mt-2">Submit</button>
    </form>
@endsection
