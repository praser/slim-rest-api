<?php

/**
 * Esta é uma classe de referência para o uso do Doctrine ORM
 */

namespace App\Models\Entity;

/**
* @Entity @Table(name="books")
*/
class Book {
  /**
   * @var int
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  public $id;

  /**
   * @var string
   * @Column(type="string")
   */
  public $name;

  /**
   * @var string
   * @Column(type="string")
   */
  public $author;

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getAuthor()
  {
    return $this->author;
  }

  public function setId(int $id)
  {
    $this->id = $id;
    return $this;
  }

  public function setName(string $name = '')
  {
    // if(!$name && !is_string($name)) {
    //   throw new \InvalidArgumentException('Book name is required', 422);
    // };

    $this->name = $name;
    return $this;
  }

  public function setAuthor(string $author = '')
  {
    // if(!$author && !is_string($author)) {
    //   throw new \InvalidArgumentException('Book author is required', 422);
    // }
    $this->author = $author;
    return $this;
  }
}