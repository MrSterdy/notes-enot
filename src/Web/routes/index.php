<?php

use NotesEnot\Core\models\Note;
use NotesEnot\Core\services\NoteService;

$notes = NoteService::getInstance()->getNotes();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"] ?? "");
    if (empty($name)) {
        http_response_code(400);
    } else {
        NoteService::getInstance()->createNote(new Note(name: $name));

        $location = $_SERVER["REQUEST_URI"];
        header("Location: $location");
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="public/app.css">

    <title>Заметки</title>
</head>
<body>
<main>
    <h1>Заметки</h1>

    <article id="main">
        <form method="POST" class="box">
            <label>
                <input type="text" name="name" placeholder="Заметка..." required>
            </label>

            <input type="submit" value="Создать заметку">
        </form>

        <?php
        if (count($notes)) {
            echo "<ul class='box'>";
            foreach ($notes as $index => $note) {
                $position = $index + 1;
                $name = $note->getName();

                echo "<li>
                          <span>
                                <span class='position'>$position.</span> 
                                <span class='name'>$name</span>
                          </span>
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<h2>У вас нет заметок</h2>";
        }
        ?>
    </article>
</main>
</body>
</html>