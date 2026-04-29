<?php

include __DIR__ . "/../src/includes/header.php" ;

unset($_SESSION['utilisateur']);

header('Location: index.php');

exit();

?>