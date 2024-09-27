<?php

class ArticleModel
{
  private $id;
  private $title;
  private $summary;
  private $category_id;
  private $author_id;
  private $date_written;
  private $content;
  private $cat_name;
  private $author_name;

  public function __construct(...$args)
  {
    $this->id = $args[0] ?? null;
    $this->title = $args[1] ?? null;
    $this->summary = $args[2] ?? null;
    $this->date_written = $args[3] ?? null;
    $this->content = $args[4] ?? null;
    $this->cat_name = $args[5] ?? null;
    $this->author_name = $args[6] ?? null;
    $this->category_id = $args[7] ?? null;
    $this->author_id = $args[8] ?? null;
  }

  // Getter methods
  public function getId()
  {
    return $this->id;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function getSummary()
  {
    return $this->summary;
  }
  public function getCategoryId()
  {
    return $this->category_id;
  }
  public function getAuthorId()
  {
    return $this->author_id;
  }
  public function getDateWritten()
  {
    return $this->date_written;
  }
  public function getContent()
  {
    return $this->content;
  }
  public function getCategoryName()
  {
    return $this->cat_name;
  }
  public function getAuthorName()
  {
    return $this->author_name;
  }
}
