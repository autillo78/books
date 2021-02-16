<?php

namespace App\Services\Books;

use App\Http\Requests\Books\StoreUpdateBookRequest;
use App\Models\Books\Author;
use App\Models\Books\Book;

class StoreUpdateBookService 
{

    
    /**
     * 
     * @param StoreUpdateBookRequest $request
     * @param int $id
     */
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
        $authorsIds = $this->getAuthorsArrayFromString($request->authors);

        // sync (no attach) the authors
        $book->authors()->sync($authorsIds);

    }


    public function storeBook(StoreUpdateBookRequest $request)
    {
        // add book
        $book = Book::create([
            'title'         => $request->title,
            'pages'         => $request->pages,
            'format_id'     => $request->format_id,
            'type_id'       => $request->type_id,
            'language_code' => $request->language_code
        ]);

         // get all the authors from string
         $authorsIds = $this->getAuthorsArrayFromString($request->authors);

         // sync (no attach) the authors
         $book->authors()->sync($authorsIds); 

    }


    /**
     *  Get the Ids for the authors
     *  If the author doesn't exist it's added
     * 
     *  @param string $stringAuthors
     *  @return array
     */
    private function getAuthorsArrayFromString(string $stringAuthors):array
    {
        $authorsIds = [];
        $authorsNames = explode(',', $stringAuthors);
        foreach ($authorsNames as $authorName) {
            if ($authorName) {
                // check out if the author exists if not add it (firstOrCreate), and get its id
                $author = Author::firstOrCreate([
                    'name' => trim($authorName)
                ]);

                $authorsIds[] = $author->id;
            }
        }
        return $authorsIds;
    }
}