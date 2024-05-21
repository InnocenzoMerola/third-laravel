<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // dd($request->user());

        $books = Book::all();

        $books = Book::paginate(5);
        return view('books.index', [
            'books' => $books,
        ]);
        // OPPURE POSSIAMO FARE:
        // return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // if (Auth::guest()) abort('401');
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (Auth::guest()) abort('401');
        $data = $request->all();
        
        $newBook = new Book();
        $newBook->title = $data['title'];
        $newBook->author = $data['author'];
        $newBook->category = $data['category'];
        $newBook->year = $data['year'];
        $newBook->description = $data['description'];
        $newBook->image = $data['image'];
        $newBook->user_id = $request->user()->id;
        $newBook->save();

        // Book::create($data);

        return redirect()->route('books.index', ['id'=>$newBook->id])->with('creation_success', $newBook);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        // $book = Book::firstoWhere('year', 2024)
        return view('books.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        if ($request->user()->id !== $book->user_id) abort('401');
        return view('books.edit',[
            'book' => $book
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {    
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'year' => 'required|integer',
            'image' => 'required',
            'description' => 'required',
        ]);
        $book = Book::findOrFail($id);
        if ($request->user()->id !== $book->user_id) abort('401');
        $book->update($request->except('_token'));

        return redirect()->route('books.index')->with('updating_success', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        if ($request->user()->id !== $book->user_id) abort('401');
        

        // Questo serve per lasciare un messaggio all'eliminazione, 
        // viene cancellato una volta letto e quindi al ricaricamento della pagina
        // viene eliminato
        return redirect()->route('books.index')->with('operation_success', $book);

        // $request->session()->put('saluto', 'ciao a tutti'); ----> Questo invece resta anche dopo il caricamento
    }
}
