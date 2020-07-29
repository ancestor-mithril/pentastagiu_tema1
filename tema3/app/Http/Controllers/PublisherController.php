<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class PublisherController extends Controller
{

    public function index()
    {
        $publishers = Publisher::all();
        return view('publisher.index', ['publishers' => $publishers]);
    }

    public function create()
    {
        return view('publisher.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $publisher = new Publisher();
        $publisher->name = $request->input('name');
        $publisher->save();
        return Redirect::to('publisher');
    }

    public function show(int $id)
    {
        $publisher = Publisher::find($id);
        return view('publisher.show', ['publisher' => $publisher]);
    }

    public function edit(int $id) // public function edit(Author $author)
    {
        $publisher = Publisher::find($id);
        return view('publisher.edit', ['publisher' => $publisher]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $updatedPublisher = Publisher::find($id);
        $updatedPublisher->name = $request->input('name');
        $updatedPublisher->save();
        return Redirect::to('publisher');
    }

    public function destroy(int $id)
    {
        DB::beginTransaction();
        $publisher = Publisher::find($id);
        $publisher->delete();
        DB::table('books')->where('publisher_id', $id)->delete();
        DB::commit();
        return Redirect::to('publisher');
    }
}
