<?php

namespace App\Services\Books;

use App\Models\Books\Book;
use App\Models\Books\BookCategory;
use App\Models\Books\BookFormat;
use App\Models\Language;

class BookService 
{


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
     * @param int $bookId for a specific book
     * @return App\Services\Books\BookService
     */
    public function __construct(int $bookId = 0)
    {
        $this->setValues($bookId);
    }


    /**
     * Set object values
     * 
     * @param int $bookId
     */
    protected function setValues(int $bookId)
    {
        $this->setCategories();
        $this->setLanguages();
        $this->setFormats();

        if ($bookId === 0) {
            $this->setBooks();
        } else {
            $this->setBookById($bookId);
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
    public function setBooks()
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
    public function setBookById(int $id)
    {
        $this->books = Book::find($id);
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
    public function setCategories()
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
    public function setLanguages()
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
    public function setFormats()
    {
        $this->formats = BookFormat::all();
    }


    /**
     * Get all the authors split by comas
     * 
     * @param App\Models\Books\Book
     * @return string 
     */
    public static function getAuthorsOneLine($authors)
    {
        $authorsNames = '';
        foreach ($authors as $author) {
            $authorsNames .= $author->name .', ';
        }

        return rtrim($authorsNames, ', ');
    }

}