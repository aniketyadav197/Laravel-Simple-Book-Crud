@extends('books.layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Books</h2>
        <a class="btn btn-primary" href="{{ route('books.create') }}">Add Book</a>
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="mb-3">
        <input type="text" name="search" placeholder="Search by title, author or year" class="form-control" value="{{ request('search') }}">
    </form>

    @if ($message = Session::get('success'))
        <div id="success-message" class="alert alert-success">{{ $message }}</div>
    @endif
    @if ($message = Session::get('error'))
        <div id="error-message" class="alert alert-danger">{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Published Year</th>
            <th>Action</th>
        </tr>
        @foreach ($books as $book)
        <tr style="cursor: pointer;" onclick="window.location='{{ route('books.show', $book->id) }}'">
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publishedYear }}</td>
            <td>
                <a class="btn btn-warning btn-sm" href="{{ route('books.edit', $book->id) }}">Edit</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <nav class="my-4">
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
</nav>

    <script>
        setTimeout(() => {
            const success = document.getElementById('success-message');
            if (success) success.style.display = 'none';

            const error = document.getElementById('error-message');
            if (error) error.style.display = 'none';
        }, 1500);
    </script>
@endsection
