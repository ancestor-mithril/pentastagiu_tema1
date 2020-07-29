<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();
        //TODO: de preluat numele de la autor si editor in $books
        return view('book.index', ['books' => $books]);
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);
        $book = new Book();
        $book->title = $request->input('title');
        $book->author_id = $request->input('author_id');
        $book->publisher_id = $request->input('publisher_id');
        $book->publisher_year = $request->input('publisher_year');
        $book->save();
        return Redirect::to('book');
    }

    public function show(int $id)
    {
        $book = Book::find($id);
        return view('book.show', ['book' => $book]);
    }

    public function edit(int $id) // public function edit(Author $author)
    {
        $book = Book::find($id);
        return view('book.edit', ['book' => $book]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);
        $updatedBook = Book::find($id);
        $updatedBook->title = $request->input('title');
        $updatedBook->save();
        return Redirect::to('book');
    }

    public function destroy(int $id)
    {
        $book = Book::find($id);
        $book->delete();
        return Redirect::to('book');
    }
}
