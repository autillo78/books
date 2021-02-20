<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreUpdateBookRequest;
use App\Http\Requests\Books\StoreUpdateBookNoteRequest;
use App\Services\Books\BookService;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (new BookService())->setValues('all');
        
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
        BookService::storeBookAndFeatures($request);

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
        $data = (new BookService())->setValues('none', $id);

        return view('books.show',compact('data'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = (new BookService())->setValues('all', $id);
        
        return view('books.edit',compact('data'));
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
        BookService::updateBookAndFeatures($request, $id);
        
        return redirect()->action([BookController::class, 'show'], ['id' => $id]);
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
        $data = (new BookService)->setValues('languages', $id, 0);

        return view('books.createNotes', compact('data'));
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
        (new BookService)::storeNote($request, $id);

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
        $data = (new BookService)->setValues('languages', $id, $noteId);

        return view('books.editNote',compact('data'));
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
        (new BookService)::updateNote($request, $id, $noteId);
        
        return redirect()->action([BookController::class, 'show'], ['book' => $id]);
    }
    
    
}
