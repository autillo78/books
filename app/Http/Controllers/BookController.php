<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookType;
use App\Models\Language;
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
        $books = Book::all();
        //$books=$books->bookAuthors;
        $types = BookType::all();
        
        return view('books.index', compact('books', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        
        $book = DB::insert('insert into books (title, pages, language_id, format, type_id, created_at) 
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

            foreach ($authors as $aut) {

                $author = DB::insert('insert into authors (name, surname) 
                        values (?, ?)', 
                        [
                            $aut, 
                            ''
                        ]);

                // get last id inserted
                $lastAuthorId =  DB::getPdo()->lastInsertId();

                DB::insert('insert into book_authors (book_id, author_id) 
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
