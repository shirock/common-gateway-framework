<?php
class Book {
    function index() {
        // $books = $query->from('book')->select();

        $index_model = array(
            'books' => array(
                new BookModel('123', 'book 123'),
                new BookModel('456', 'Book XYZ')
            ),
            'time'  => date('Y-m-d H:i:s')
        );
        return $index_model;
    }

    function get($isbn) {
        /*
        $book = $query->from('book')->
                    ->where(array('isbn' => $isbn))
                    ->select();
        */
        if ($isbn != '123') {
            HttpResponse::not_found();
        }
        return new BookModel('123', 'book 123');
    }
}

class BookModel {
    var $isbn;
    var $title;
    function __construct($isbn, $title) {
        $this->isbn = $isbn;
        $this->title = $title;
    }
}
