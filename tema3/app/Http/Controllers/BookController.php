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
        $books = Book::with('author')->with('publisher')->get();
        //dd($books[0]->author, $books[0]->publisher, $books[0]);
        return view('book.index', ['books' => $books]);
    }

    public function create()
    {
        $authors = Author::all();
        if ($authors->isEmpty()) {
            return Redirect::to('author/create');
        }
        $publishers = Publisher::all();
        if ($publishers->isEmpty()) {
            return Redirect::to('publisher/create');
        }
        $authors = Author::pluck('name', 'id');
        $publishers = Publisher::pluck('name', 'id');
        return view('book.create', ['authors' => $authors, 'publishers' => $publishers]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'publisher_year' => 'required|integer',
        ]);

        {//TODO: asta ar trebuii mutata intr-o clasa de validare
            $author = Author::find($request->input('author_id'));
            $publisher = Publisher::find($request->input('publisher_id'));

            if ($author === null || $publisher === null) {
                return Redirect::back()->withErrors(['invalid form data']);
            }

        }

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
        $authors = Author::pluck('name', 'id');
        $publishers = Publisher::pluck('name', 'id');
        return view('book.edit', ['book' => $book, 'authors' => $authors, 'publishers' => $publishers]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'publisher_year' => 'required|integer',
        ]);

        {//TODO: asta ar trebuii mutata intr-o clasa de validare
            $author = Author::find($request->input('author_id'));
            $publisher = Publisher::find($request->input('publisher_id'));
            if ($author === null || $publisher === null) {
                return Redirect::back()->withErrors(['invalid form data']);
            }
        }

        $updatedBook = Book::find($id);
        $updatedBook->title = $request->input('title');
        $updatedBook->author_id = $request->input('author_id');
        $updatedBook->publisher_id = $request->input('publisher_id');
        $updatedBook->publisher_year = $request->input('publisher_year');
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
