<?php

namespace NotesEnot\Core;

use NotesEnot\Core\db\Database;

class Loader {
    public static function load(): void
    {
        Database::getInstance()->connect();
    }
}