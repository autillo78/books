<?php

namespace App\Services\Books;

use App\Http\Requests\Books\StoreUpdateBookRequest;
use App\Models\Books\Author;
use App\Models\Books\Book;

class StoreUpdateBookService 
{

    public function __construct()
    {   }

    public function updateBook(StoreUpdateBookRequest $request, int $id)
    {
        // get book by id
        $book = Book::find($id);

        // update book values
        $book->title         = $request->title;
        $book->pages         = $request->pages;
        $book->format_id     = $request->format_id;
        $book->type_id       = $request->type_id;
        $book->language_code = $request->language_code;
        $book->save();


        // get all the authors from string
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

    }
}