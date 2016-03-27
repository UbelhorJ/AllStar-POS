<?php 

function get_last_three_release_notes() {
    global $db;

    $query = 'SELECT * FROM release_notes
              ORDER BY dateTime DESC
              LIMIT 3';

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }
}

?>