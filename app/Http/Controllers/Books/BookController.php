<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Books\Language;
use Database\Seeders\BookFormartsSeeder;
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
        // $books = Book::find(4);
        // return $books->authors;

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
        $langId = Language::select('id')
                            ->where('code','=', $request['language'])
                            ->first();
        //return $langId->id;

        
        $book = DB::insert('insert into books (title, pages, language_id, format_id, type_id, created_at) 
                            values (?, ?, ?, ?, ?, ?)', 
                            [
                                $request['title'], 
                                $request['pages'], 
                                $langId->id, 
                                $request['format'], 
                                $request['type'], 
                                NOW()
                            ]);

        // get last id inserted
        $lastBookId =  DB::getPdo()->lastInsertId();


        if ($request['author']) {

            $authors = explode(',', $request['author']);

            foreach ($authors as $author) {

                DB::insert('insert into authors (name) 
                        values (?)', 
                        [
                            trim($author), 
                            ''
                        ]);

                // get last id inserted
                $lastAuthorId =  DB::getPdo()->lastInsertId();


                // REPEAT USING SYNC (ELOQUENT)
                DB::insert('insert into author_book (book_id, author_id) 
                            values (?, ?)', 
                            [
                                $lastBookId,
                                $lastAuthorId
                            ]);
            }
        }

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
        echo 'update';
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
