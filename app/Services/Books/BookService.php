<?php

namespace App\Services\Books;

use App\Http\Requests\Books\StoreUpdateBookNoteRequest;
use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Language;
use App\Http\Requests\Books\StoreUpdateBookRequest;
use App\Models\Books\Author;
use App\Models\Books\BookNote;

class BookService 
{

    /**
     * Book id
     * @var int $bookId; 
     */

    /**
     * Book/s
     * @var Book
     */
    protected $books;

    /**
     * Note
     * @var BookNote
     */
    protected $noteById;

    /**
     * Authors in one line
     * @var String
     */
    protected $authorsOneLine;

    /**
     * All categories
     * @var Category
     */
    protected $categories;

    /**
     * All languages
     * @var Language
     */
    protected $languages;

    /**
     * All formats
     * @var Format
     */
    protected $formats;


    
    /**
     * Class constructor
     * 
     */
    public function __construct() {}


    /**
     * Set object values
     * 
     * @param string $features all|languages|formats|categories|none
     * @param int    $bookId all the books or just one by id
     * @param int    $noteId 
     * @return BookService
     */
    public function setValues(string $features = 'none', int $bookId = 0, int $noteId = -1)
    {
        
        switch ($features) {
            case 'all':
                $this->setCategories();
                $this->setLanguages();
                $this->setFormats();
                break;
            
            case 'languages':
                $this->setLanguages();
                break;            
        }
        
        $this->setBookId($bookId);

        // get all the books 
        if ($bookId === 0) {
            $this->setBooks();
        }
        // for notes only (no save here the book obj)
        elseif ($noteId >= 0) {
            $this->setNoteById($noteId);
        }
        // just one book by id
        else {
            $this->setBookById();
            $this->setAuthorsOneLine();
        }

        return $this;
    }


    /**
     *  Get book id
     * 
     * @return int $bookId
     */
    public function getBookId()
    {
        return $this->bookId;
    }


    /**
     * Set book id
     * 
     * @param int $bookId
     * @return App\Models\Books\Book
     */
    protected function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }


    /**
     * Get all the books
     * 
     * @return App\Models\Books\Book
     */
    public function getBooks()
    {
        return $this->books;
    }


    /**
     * Set all the books
     * 
     * @return App\Models\Books\Book
     */
    protected function setBooks()
    {
        $this->books = Book::orderBy('id', 'desc')->get();
    }


    /**
     * Get book by id
     * 
     * @return App\Models\Books\Book
     */
    protected function setBookById()
    {
        $this->books = Book::find($this->getBookId());
    }


    /**
     * Get note by id
     * 
     * @return BookNote 
     */
    public function getNoteById()
    {
        return $this->noteById;
    }
    

    /**
     * Set specific note from a book
     * 
     * @param int  $noteId
     */
    protected function setNoteById($noteId)
    {
        $this->noteById = Book::find($this->getBookId())->notes()->find($noteId);
    }


    /**
     * Get all the categories
     * 
     * @return App\Models\Books\BookCategory
     */
    public function getCategories()
    {
        return $this->categories;
    }


    /**
     * Set all the categories
     */
    protected function setCategories()
    {
        $this->categories = BookCategory::all();
    }


    /**
     * Get all the languages
     * 
     * @return App\Models\Books\Language
     */
    public function getLanguages()
    {
        return $this->languages;
    }


    /**
     * Set all the categories
     * 
     * @return App\Models\Books\Language
     */
    protected function setLanguages()
    {
        $this->languages = Language::all();
    }


    /**
     * Get all the formats
     * 
     * @return App\Models\Books\BookFormat
     */
    public function getFormats()
    {
       return $this->formats;
    }


     /**
     * set all the formats
     * 
     * @return App\Models\Books\BookFormat
     */
    protected function setFormats()
    {
        $this->formats = BookFormat::all();
    }


    /**
     * Set all the authors split by comas
     */
    protected function setAuthorsOneLine()
    {
        $authorsNames = '';
        foreach ($this->getBooks()->authors as $author) {
            $authorsNames .= $author->name .', ';
        }

        $this->authorsOneLine = rtrim($authorsNames, ', ');
    }

    /**
     * Get authors one line
     * 
     * @return string 
     */
    public function getAuthorsOneLine()
    {
        return $this->authorsOneLine;
    }


    /*
    * *************************  STATIC METHODS  ***********************************
    */

    /**
     * Store new book with its features
     * 
     * @param \App\Http\Requests\Books\StoreUpdateBookRequest $request 
     */
    public static function storeBookAndFeatures(StoreUpdateBookRequest $request)
    {
        $book = Book::create([
            'title'         => $request->title,
            'pages'         => $request->pages,
            'format_id'     => $request->format_id,
            'type_id'       => $request->type_id,
            'language_code' => $request->language_code
        ]);
        
        // get all the authors from string
        $authorsIds = self::getAuthorsArrayFromString($request->authors);

        // sync (no attach) the authors
        $book->authors()->sync($authorsIds); 
    }


    /**
     * Update book by id and its features
     * 
     * @param StoreUpdateBookRequest $request
     * @param int $bookId
     */
    public static function updateBookAndFeatures(StoreUpdateBookRequest $request, int $bookId)
    {
        // get book by id
        $book = Book::find($bookId);

        // update book values
        $book->title         = $request->title;
        $book->pages         = $request->pages;
        $book->format_id     = $request->format_id;
        $book->type_id       = $request->type_id;
        $book->language_code = $request->language_code;
        $book->save();

        // get all the authors from string
        $authorsIds = self::getAuthorsArrayFromString($request->authors);

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
    protected static function getAuthorsArrayFromString(string $stringAuthors):array
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



    /**
     * Update note
     * 
     * @param StoreUpdateBookNoteRequest $request
     * @param int $bookId
     * @param int $noteId
     */
    public static function updateNote(StoreUpdateBookNoteRequest $request, int $bookId, int $noteId)
    {
        // get book by id
        $book = Book::find($bookId);
        $note = $book->notes->find($noteId);

        $note->text = $request->text;
        $note->pages = $request->pages;
        $note->language_code = $request->language_code;
        $note->save();
    }


    /**
     * save a new note for a book by id
     * 
     * @param StoreUpdateBookNoteRequest $request
     * @param int $bookId
     */
    public static function storeNote(StoreUpdateBookNoteRequest $request, int $bookId)
    {
        BookNote::create([
            'pages'         => $request->pages,
            'text'          => $request->text,
            'language_code' => $request->language_code,
            'book_id'       => $bookId,
            'created_at'    => now()
        ]);
    }

}