<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

use Exception;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%")
                  ->orWhere('publishedYear' , 'like', "%$search%")  
                  ->orWhere('author', 'like', "%$search%");
        }

        $books = $query->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');

    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'publishedYear' => 'required|digits_between:1,10',
        ]);

        Book::create($request->only(['title', 'author', 'publishedYear']));

        return redirect()
            ->route('books.index')
            ->with('success', 'Book created successfully.');
    } catch (\Exception $e) {
        \Log::error('Error creating book: ' . $e->getMessage());

        return redirect()
             ->route('books.index')
            ->with('error', 'Failed to create the book: ' . $e->getMessage());
    }
}



    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }


    public function edit(Book  $book)
    {
        return view('books.edit', compact('book'));

    }


    public function update(Request $request, Book $book)
{


    try {

        $request->validate([
        'title' => 'required|string|max:255|unique:books,title,' . $book->id,
        'author' => 'required|string|max:255',
        'publishedYear' => 'required|digits_between:1,10',
    ]);
        $book->update($request->only(['title', 'author', 'publishedYear']));

        return redirect()
            ->route('books.index')
            ->with('success', 'Book updated successfully 2.');
    } catch (\Exception $e) {
        Log::error('Error updating book: ' . $e->getMessage());

        return redirect()
            ->route('books.index')
            ->with('error', 'Failed to update the book: ' . $e->getMessage());
    }
}


    public function destroy(Book $book)
{
    try {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Book deleted successfully.');
    } catch (\Exception $e) {
        \Log::error('Error deleting book: ' . $e->getMessage());

        return redirect()
            ->route('books.index')
            ->with('error', 'Failed to delete the book: ' . $e->getMessage());
    }
}

}
