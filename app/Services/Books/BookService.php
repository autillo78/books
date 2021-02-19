<?php

namespace App\Services\Books;

use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Language;
use App\Http\Requests\Books\StoreUpdateBookRequest;
use App\Models\Books\Author;

class BookService 
{

     /**
     * Book id
     * @var int
     */
    protected $bookId;

     /**
     * Controller method
     * @var string
     */
    protected $method;

    /**
     * Book/s
     * @var Book
     */
    protected $books;

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
     * @param  string       $method method used in the controller
     * @param  int          $bookId for a specific book
     * @return BookService
     */
    public function __construct(string $method = 'index', int $bookId = 0)
    {
        $this->bookId = $bookId;
        $this->method = $method;

        $this->setValues();
    }


    /**
     * Set object values
     * 
     */
    protected function setValues()
    {
        // get books features (languages, formats...) only for index and edit
        if (in_array($this->method, ['index', 'edit'])) {

            $this->setCategories();
            $this->setLanguages();
            $this->setFormats();
        }

        // get all the books or just one by id
        if ($this->bookId === 0) {

            $this->setBooks();
        } else {

            $book = $this->setBookById($this->bookId);
            $this->setAuthorsOneLine($book);
        }
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
        $this->books = Book::all();
    }

    /**
     * Get book by id
     * 
     * @return App\Models\Books\Book
     */
    public function getBookById()
    {
        return $this->books;
    }

    /**
     * Get book by id
     * 
     * @param int $id
     * @return App\Models\Books\Book
     */
    protected function setBookById(int $id)
    {
        return $this->books = Book::find($id);
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
     * 
     * @param  App\Models\Books\Book $book
     */
    protected function setAuthorsOneLine($book)
    {
        $authorsNames = '';
        foreach ($book->authors as $author) {
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

}