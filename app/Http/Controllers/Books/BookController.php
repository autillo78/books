<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreUpdateBookRequest;
use App\Http\Requests\Books\StoreUpdateBookNoteRequest;
use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Language;
use App\Models\Books\Author;
use App\Models\Books\BookNote;
use App\Services\Books\BookService;
use App\Services\Books\StoreUpdateBookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $books  = Book::orderBy('id', 'DESC')->get();
        // $formats = BookFormat::all();
        // $categories = BookCategory::all();
        // $languages = Language::all();        
        //return view('books.indexest', compact('books', 'categories', 'formats', 'languages'));

        $data = new BookService();
        return view('books.index', compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Books\StoreUpdateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBookRequest $request)
    {
        //return $request;
        
       (new StoreUpdateBookService)->storeBook($request);

        return redirect()->action([BookController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = (new BookService($id))->getBooks();

        return view('books.show',compact('book'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = new BookService($id);
        $book = $data->getBookById();
        $formats = $data->getFormats();
        $categories = $data->getCategories();
        $languages = $data->getLanguages();
        $authorsNames = $data::getAuthorsOneLine($book->authors);

        return view('books.edit',compact('book', 'formats', 'categories', 'languages', 'authorsNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Books\StoreUpdateBookRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateBookRequest $request, $id)
    {
        //return $request;

        (New StoreUpdateBookService())->updateBook($request, $id);
        
        return redirect()->action([BookController::class, 'show'], ['book' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /* 
    *   ************************  NOTES  *********************************************
    */

    /**
     * Display the specified note.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createNote($id)
    {
        $bookNotes = Book::find($id)->notes;
        $languages = Language::all();

        return view('books.createNotes', compact('bookNotes', 'id', 'languages'));
    }


    /**
     * Store a newly created note in storage.
     *
     * @param  App\Http\Requests\Books\StoreUpdateBookNoteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeNote(StoreUpdateBookNoteRequest $request, int $id)
    {
        BookNote::create([
            'pages'         => $request->pages,
            'text'          => $request->text,
            'language_code' => $request->language_code,
            'book_id'       => $id,
            'created_at'    => now()
        ]);

        return redirect()->action([BookController::class, 'show'], ['book' => $id]);

    }


    /**
     * Display the note.
     *
     * @param  int  $id
     * @param  int  $noteId
     * @return \Illuminate\Http\Response
     */
    public function editNote(int $id, int $noteId)
    {
        $book = Book::find($id);
        $note = $book->notes->find($noteId);
        $languages = Language::all();
        
        return view('books.editNote',compact('book', 'note', 'languages'));
    }


    /**
     * Update the note in storage.
     *
     * @param  StoreUpdateBookNoteRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNote(StoreUpdateBookNoteRequest $request, $id, $noteId)
    {
        $book = Book::find($id);
        $note = $book->notes->find($noteId);

        $note->text = $request->text;
        $note->pages = $request->pages;
        $note->language_code = $request->language_code;
        $note->save();
        

        // (New StoreUpdateBookService())->updateBook($request, $id);
        return redirect()->action([BookController::class, 'show'], ['book' => $id]);
    }
    
    
}
