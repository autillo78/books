<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\storeReadingRequest;
use App\Models\Books\Book;
use App\Models\Books\Reading;

class ReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('readings.index', compact('books'));
    }

    /**
     * Show the form for creating a new reading.
     * required: books
     * request: date / starting page / bookTitle
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        
        return view('readings.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  storeReadingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeReadingRequest $request)
    {
        Reading::create([
            'date'      => $request->date, 
            'last_page' => $request->lastPage, 
            'book_id'   => $request->bookId
        ]);

        return redirect()->action([ReadingController::class, 'index']);
    }

    
}
