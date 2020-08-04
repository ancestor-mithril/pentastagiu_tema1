<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        //dd($authors);
        return view('author.index', ['authors' => $authors]);
    }

    public function create()
    {
        return view('author.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $author = new Author();
        $author->name = $request->input('name');
        $author->save();
        return Redirect::to('author');
    }

    public function show(int $id)
    {
        $author = Author::find($id);
        return view('author.show', ['author' => $author]);
    }

    public function edit(int $id) // public function edit(Author $author)
    {
        $author = Author::find($id);
        return view('author.edit', ['author' => $author]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $updatedAuthor = Author::find($id);
        $updatedAuthor->name = $request->input('name');
        $updatedAuthor->save();
        return Redirect::to('author');
    }

    public function destroy(int $id)
    {
        $author = Author::find($id);
        $author->delete();
        return Redirect::to('author');
    }
}
