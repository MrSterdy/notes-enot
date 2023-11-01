<?php

namespace NotesEnot\Core\services;

use NotesEnot\Core\db\Database;
use NotesEnot\Core\models\Note;
use NotesEnot\Core\utils\Singleton;

class NoteService
{
    use Singleton;

    private const TABLE_NAME = "Notes";

    private readonly Database $database;

    protected function __construct()
    {
        $this->database = Database::getInstance();

        $this->init();
    }

    private function init(): void
    {
        $table = self::TABLE_NAME;

        Database::getInstance()->getConnection()->query("CREATE TABLE IF NOT EXISTS $table (id INT PRIMARY KEY AUTO_INCREMENT, name TINYTEXT NOT NULL)");
    }

    /**
     * @return Note[]
     */
    public function getNotes(): array
    {
        $table = self::TABLE_NAME;

        $result = $this->database->getConnection()->query("SELECT * FROM $table")->fetch_all();

        return array_map(fn(array $obj) => new Note(intval($obj[0]), $obj[1]), $result);
    }

    public function createNote(Note $note): void
    {
        $table = self::TABLE_NAME;

        $name = $note->getName();

        $statement = $this->database->getConnection()->prepare("INSERT INTO $table (name) VALUES (?)");
        $statement->bind_param("s", $name);
        $statement->execute();
    }
}