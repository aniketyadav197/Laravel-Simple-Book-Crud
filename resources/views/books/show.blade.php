@extends('books.layout')

@section('content')
    <h2 class="mb-4">Book Details</h2>

    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-light rounded shadow-sm">
                <h3>{{ $book->title }}</h3>
                <h5 class="text-muted">{{ $book->author }}</h5>
                <p><strong>Published Year:</strong> {{ $book->publishedYear }}</p>
            </div>
        </div>

        <div class="col-md-6 d-flex justify-content-center">
         <div style="position: relative; max-width: 300px; width: 100%;">
    <img src="{{ asset('images/notebook.jpg') }}" alt="Notebook" style="width: 100%; display: block; border-radius: 8px;">

    <div style="
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #4b3223;
        max-width: 90%;
        text-align: center;
    ">
        <h4 style="margin: 0;">{{ $book->title }}</h4>
        <h6 style="margin: 0;">{{ $book->author }}</h6>
        <small>{{ $book->publishedYear }}</small>
    </div>
</div>

        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
