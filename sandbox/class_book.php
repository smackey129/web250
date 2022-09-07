<?php

class Book {

  var $title;
  var $author;
 
  function show_due_date(){
    return date('d F, Y');
  }

  function book_and_author(){
    return "This book is titled ". $this->title ." and is written by ". $this->author .".<br>";
  }
}

$book = new Book;
$book->title = "The Hobbit";
$book->author = "J. R. R. Tolkien";
echo $book->book_and_author();
echo $book->show_due_date();

$book2 = new Book;
$book2->title = "Lord of the Flies";
$book2->author = "William Golding";
echo $book2->book_and_author();
echo $book2->show_due_date();