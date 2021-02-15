<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\NewUpdateBookRequest;
use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Language;
use App\Models\Books\Author;
use App\Models\Books\BookNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = Book::orderBy('id', 'DESC')->get();
        $formats = BookFormat::all();
        $categories = BookCategory::all();
        $languages = Language::all();
        
        return view('books.index', compact('books', 'categories', 'formats', 'languages'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Books\NewUpdateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewUpdateBookRequest $request)
    {
        //return $request;

        // // validation
        // $rules = [
        //     'title' => 'required | max:255',
        //     'pages' => 'nullable|numeric',
        //     'format_id' => 'required|numeric',
        //     'type_id' => 'required|numeric',
        //     'language_code' => 'required|string|max:3'
        // ];

        // $messages = [
        //     'title.required' => 'Title is needed',
        //     'title.max' => 'Title must be shorter than 255 characters',
        //     'pages.number' => 'Pages must be a number',
        //     'format_id.required' => 'Format is needed',
        //     'format_id.numeric' => 'Format is needed',
        //     'type_id.required' => 'Type is needed',
        //     'type_id.numeric' => 'Type is needed',
        // ];

        // Validator::make($request->all(), $rules, $messages)->validate();
        

        // add book
        $book = Book::create([
            'title' => $request->title,
            'pages' => $request->pages,
            'format_id' => $request->format_id,
            'type_id' => $request->type_id,
            'language_code' => $request->language_code
        ]);


        // check out if the author exists, if not add it (firstOrCreate)
        $authorsIds = [];
        $authorsNames = explode(',', $request->authors);
        foreach ($authorsNames as $authorName) {
            if ($authorName) {
                $author = Author::firstOrCreate([
                    'name' => trim($authorName)
                ]);

                $authorsIds[] = $author->id;
            }
        }


        // link authors with the book
        $book->authors()->sync($authorsIds);


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
        $book = Book::find($id);

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
        $book = Book::find($id);
        $formats = BookFormat::all();
        $categories = BookCategory::all();
        $languages = Language::all();

        $authorsNames = '';
        foreach ($book->authors as $author) {
            $authorsNames .= $author->name .', ';
        }
        $authorsNames = rtrim($authorsNames, ', ');

        return view('books.edit',compact('book', 'formats', 'categories', 'languages', 'authorsNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request;

        $book = Book::find($id);
        $book->title = $request->title;
        $book->pages = $request->pages;
        $book->format_id = $request->format_id;
        $book->type_id = $request->type_id;
        $book->language_code = $request->language_code;
        $book->save();


        $authorsIds = [];
        $authorsNames = explode(',', $request->authors);
        foreach ($authorsNames as $authorName) {
            if ($authorName) {
                $author = Author::firstOrCreate([
                    'name' => trim($authorName)
                ]);

                $authorsIds[] = $author->id;
            }
        }

        $book->authors()->sync($authorsIds);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeNote(Request $request, int $id)
    {
        BookNote::create([
            'pages' => $request->pages,
            'text' => $request->text,
            'language_code' => $request->language_code,
            'book_id' => $id,
            'created_at' => now()
        ]);

        return redirect()->action([BookController::class, 'show'], ['book' => $id]);

    }
    
}
