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

        $files = glob(getenv('TEMP') . '/book-*');
        foreach ($files as $file) {
            $book = unserialize(file_get_contents($file));
            $index_model['books'][] = new BookModel($book->isbn, $book->title);
        }

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

    function post() {
        if (empty($_POST['isbn']) or empty($_POST['title']))
            HttpResponse::badRequest();

        $book = new BookModel($_POST['isbn'], $_POST['title']);
        file_put_contents(getenv('TEMP') . '/book-' . $book->isbn, serialize($book));
        return HttpResponse::OK;
    }

    function put($isbn = false) {
        if (empty($isbn))
            HttpResponse::badRequest();

        $data_filepath = getenv('TEMP') . '/book-' . $isbn;
        if (!file_exists($data_filepath)) {
            HttpResponse::notFound();
        }
        $book = unserialize(file_get_contents($data_filepath));
        $book->title = $_REQUEST['title'];
        file_put_contents($data_filepath, serialize($book));
        return HttpResponse::OK;
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
