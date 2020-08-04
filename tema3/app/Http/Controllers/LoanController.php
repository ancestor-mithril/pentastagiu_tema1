<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('book')->with('user')->get();
        return view('loan.index', ['loans' => $loans]);
    }

    public function create()
    {
        $books = Book::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('loan.create', ["books" => $books, "users" => $users]);
    }

    public function store(Request $request)
    {
        //return Redirect::to('loan')->withErrors(["Book already lent during this tiem period"]);

        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'loan_begin' => 'required|date',
            'loan_end' => 'required|date',
        ]);

        {//TODO: asta ar trebuii mutata intr-o clasa de validare
            try {
                $loan_begin = Carbon::createFromFormat("m/d/Y", $request->input('loan_begin'))
                    ->format("Y-m-d");
                $loan_end = Carbon::createFromFormat("m/d/Y", $request->input('loan_end'))
                    ->format("Y-m-d");
            } catch (\Exception $exception) {
                return Redirect::back()->withErrors(["Incorrect date format"]);
            }

            $user = User::find($request->input('user_id'));
            $book = Book::find($request->input('book_id'));
            if ($user === null || $book === null)
                return Redirect::back()->withErrors(["invalid form data"]);
            if (Carbon::parse($loan_end)->greaterThanOrEqualTo(Carbon::parse($loan_begin)))
                return Redirect::back()->withErrors(["You cannot return the book before you loan it"]);

            $loans = Loan::where('book_id', $request->input('book_id'))->get();

            foreach ($loans as $loan) {
                if (Carbon::parse($loan_begin)->greaterThanOrEqualTo(Carbon::parse($loan->loan_begin))
                    && Carbon::parse($loan_begin)->lessThanOrEqualTo(Carbon::parse($loan->loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
                if (Carbon::parse($loan_end)->greaterThanOrEqualTo(Carbon::parse($loan->loan_begin))
                    && Carbon::parse($loan_end)->lessThanOrEqualTo(Carbon::parse($loan->loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
                if (Carbon::parse($loan->loan_begin)->greaterThanOrEqualTo(Carbon::parse($loan_begin))
                    && Carbon::parse($loan->loan_begin)->lessThanOrEqualTo(Carbon::parse($loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
                if (Carbon::parse($loan->loan_beginloan_end)->greaterThanOrEqualTo(Carbon::parse($loan_begin))
                    && Carbon::parse($loan->loan_beginloan_end)->lessThanOrEqualTo(Carbon::parse($loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
            }
        }


        $loan = new Loan();
        $loan->user_id = $request->input('user_id');
        $loan->book_id = $request->input('book_id');
        $loan->loan_begin = Carbon::createFromFormat("m/d/Y", $request->input('loan_begin'))
            ->format("Y-m-d");
        //dd($loan);
        $loan->loan_end = Carbon::createFromFormat("m/d/Y", $request->input('loan_end'))
            ->format("Y-m-d");
        $loan->save();
        return Redirect::to('loan');
    }

    public function show(int $id)
    {
        $loan = Loan::find($id);
        return view('loan.show', ['loan' => $loan]);
    }

    public function edit(int $id)
    {
        $loan = Loan::find($id);
        $books = Book::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        //dd(Carbon::createFromFormat("Y-m-d H:i:s", $loan->loan_begin)->format("m/d/Y"));
        $loan->loan_begin = Carbon::createFromFormat("Y-m-d H:i:s", $loan->loan_begin)->format("m/d/Y");
        $loan->loan_end = Carbon::createFromFormat("Y-m-d H:i:s", $loan->loan_end)->format("m/d/Y");
        return view('loan.edit', ['loan' => $loan, 'books' => $books, 'users' => $users]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'loan_begin' => 'required',
            'loan_end' => 'required',
        ]);
        {//TODO: asta ar trebuii mutata intr-o clasa de validare
            try {
                $loan_begin = Carbon::createFromFormat("m/d/Y", $request->input('loan_begin'))
                    ->format("Y-m-d");
                $loan_end = Carbon::createFromFormat("m/d/Y", $request->input('loan_end'))
                    ->format("Y-m-d");
            } catch (\Exception $exception) {
                return Redirect::back()->withErrors(["Incorrect date format"]);
            }

            $user = User::find($request->input('user_id'));
            $book = Book::find($request->input('book_id'));
            if ($user === null || $book === null)
                return Redirect::back()->withErrors(["invalid form data"]);
            if (Carbon::parse($loan_end)->greaterThanOrEqualTo(Carbon::parse($loan_begin)))
                return Redirect::back()->withErrors(["You cannot return the book before you loan it"]);

            $loans = Loan::where('book_id', $request->input('book_id'))->get();

            foreach ($loans as $loan) {
                if (Carbon::parse($loan_begin)->greaterThanOrEqualTo(Carbon::parse($loan->loan_begin))
                    && Carbon::parse($loan_begin)->lessThanOrEqualTo(Carbon::parse($loan->loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
                if (Carbon::parse($loan_end)->greaterThanOrEqualTo(Carbon::parse($loan->loan_begin))
                    && Carbon::parse($loan_end)->lessThanOrEqualTo(Carbon::parse($loan->loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
                if (Carbon::parse($loan->loan_begin)->greaterThanOrEqualTo(Carbon::parse($loan_begin))
                    && Carbon::parse($loan->loan_begin)->lessThanOrEqualTo(Carbon::parse($loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
                if (Carbon::parse($loan->loan_beginloan_end)->greaterThanOrEqualTo(Carbon::parse($loan_begin))
                    && Carbon::parse($loan->loan_beginloan_end)->lessThanOrEqualTo(Carbon::parse($loan_end)))
                    return Redirect::back()->withErrors(["Book already lent during this tiem period"]);
            }
        }

        $updatedLoan = Loan::find($id);
        $updatedLoan->user_id = $request->input('user_id');
        $updatedLoan->book_id = $request->input('book_id');
        $loan->loan_begin = Carbon::createFromFormat("m/d/Y", $request->input('loan_begin'))
            ->format("Y-m-d");
        $loan->loan_end = Carbon::createFromFormat("m/d/Y", $request->input('loan_end'))
            ->format("Y-m-d");
        $updatedLoan->save();
        return Redirect::to('loan');
    }

    public function destroy(int $id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return Redirect::to('loan');
    }
}
