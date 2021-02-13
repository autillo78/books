<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Language;
use App\Models\Books\Author;
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

        $books = Book::orderBy('id', 'DESC')->get();
        $formats = BookFormat::all();
        $categories = BookCategory::all();
        $languages = Language::all();
        
        return view('books.index', compact('books', 'categories', 'formats', 'languages'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

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
            $author = Author::firstOrCreate([
                'name' => $authorName
            ]);

            $authorsIds[] = $author->id;
        }


        // link authors with the book
        $book->authors()->sync($authorsIds);


              
        // $book = DB::insert('insert into books (title, pages, language_code, format_id, type_id) 
        //                     values (?, ?, ?, ?, ?)', 
        //                     [
        //                         $request['title'],
        //                         $request['pages'],
        //                         $request['language_code'],
        //                         $request['format'],
        //                         $request['type']
        //                     ]);

        // // get last id inserted
        // $lastBookId =  DB::getPdo()->lastInsertId();


        // if ($request['author']) {

        //     $authors = explode(',', $request['author']);

        //     foreach ($authors as $author) {

        //         DB::insert('insert into authors (name) 
        //                 values (?)', 
        //                 [
        //                     trim($author), 
        //                     ''
        //                 ]);

        //         // get last id inserted
        //         $lastAuthorId =  DB::getPdo()->lastInsertId();


        //         // REPEAT USING SYNC (ELOQUENT)
        //         DB::insert('insert into author_book (book_id, author_id) 
        //                     values (?, ?)', 
        //                     [
        //                         $lastBookId,
        //                         $lastAuthorId
        //                     ]);
        //     }
        // }

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

        return view('books.edit',compact('book', 'formats', 'categories', 'languages'));
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
        $book->language_id = $request->language_id;
        $book->save();


        // now only allow update the same number of authors logged
        // you can't delete or add authors
        $authorsIds = explode(',', $request->authors_ids);
        $authorsNames = explode(',', str_replace(', ', ',', $request->authors));
        for ($i=0; $i < count($authorsIds); $i++) { 
            $author = Author::find($authorsIds[$i]);
            $author->name = $authorsNames[$i];
            $author->save();
        }
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
}
