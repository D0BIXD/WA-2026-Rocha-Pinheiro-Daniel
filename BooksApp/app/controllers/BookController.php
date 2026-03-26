<?php


// Výchozí metoda pro zobrazení úvodní stránky
class BookController {
    public function index() {
        require_once '../app/views/books/book_list.php';
    }
}