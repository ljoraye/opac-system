<?php
class Book {
    private $title;
    private $author;
    private $category;
    private $year;
    private $due_date;

    public function __construct($title, $author, $category, $year, $due_date = null){
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->year = $year;
        $this->due_date = $due_date;
    }

    public function getTitle(){ return $this->title; }
    public function getAuthor(){ return $this->author; }
    public function getCategory(){ return $this->category; }
    public function getYear(){ return $this->year; }
    public function getDueDate(){ return $this->due_date; }
}
?>