<?php

define('BASE_URL', '/comem-archidep-php-todo-exercise/'); // doit correspondre au demin de base: 
define('DB_USER', 'todolist');
define('DB_PASS', 'pouly');
define('DB_NAME', 'todolist');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '8889');

$db = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASS);
$items = array();

if (isset($_POST['action'])) {
  switch($_POST['action']) {

    /**
     * Insert a new task into the database, then redirect to the base URL.
     */
    case 'new':

      $title = $_POST['title'];
      if ($title && $title !== '') {
        $insertQuery = 'INSERT INTO todo VALUES(NULL, \''.$title.'\', FALSE, CURRENT_TIMESTAMP)';
        if (!$db->query($insertQuery)) {
          die(print_r($db->errorInfo(), true));
        }
      }

      header('Location: '.BASE_URL);
      die();

    /**
     * Toggle a task (i.e. if it is done, undo it; if it is not done, mark it as done),
     * then redirect to the base URL.
     */
    case 'toggle':

      $id = $_POST['id'];
      if(is_numeric($id)) {
        $updateQuery = 'UPDATE todo
        SET done = IF(done=1, 0, 1);'; // IMPLEMENT ME
        if(!$db->query($updateQuery)) {
          die(print_r($db->errorInfo(), true));
        }
      }

      header('Location: '.BASE_URL);
      die();

    /**
     * Delete a task, then redirect to the base URL.
     */
    case 'delete':

      $id = $_POST['id'];
      if(is_numeric($id)) {
        $deleteQuery = ''; // IMPLEMENT ME
        if(!$db->query($deleteQuery)) {
          die(print_r($db->errorInfo(), true));
        }
      }

      header('Location: '.BASE_URL);
      die();

    default:
      break;
  }
}

/**
 * Select all tasks from the database.
 */
$selectQuery = ''; // IMPLEMENT ME
$items = $db->query($selectQuery);
?>

<html>
  <head>
    <title>TodoList</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
      button {
        cursor: pointer;
      }
      form {
        margin: 0;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <header>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>TodoList</strong>
          </a>
        </div>
      </div>
    </header>

    <main role="main" class='offset-3 col-6 mt-3'>

      <!-- Todo item creation form -->
      <form action='<?= BASE_URL ?>' method='post' class='form-inline justify-content-center'>
        <input type='hidden' name='action' value='new' />

        <div class='form-group'>
          <label for='task-title' class='sr-only'>Title</label>
          <input id='task-title' class='form-control' name='title' type='text' placeholder='Task Title'>
        </div>

        <button type='submit' class='btn btn-primary ml-2'>Add</button>
      </form>

      <!-- Todo list -->
      <div class='list-group mt-3'>

        <!-- Todo items -->
        <?php foreach($items as $item): ?>
          <div class='list-group-item d-flex justify-content-between align-items-center<?php if($item['done']): ?> list-group-item-success<?php else: ?> list-group-item-warning<?php endif;?>'>

            <div class='title'><?= $item['title'] ?></div>

            <!-- Todo item controls -->
            <form action='<?= BASE_URL ?>' method='post'>
              <input type='hidden' name='id' value='<?= $item['id'] ?>' />

              <div class='btn-group btn-group-sm'</div>

                <!-- Todo item toggle button -->
                <button type='submit' name='action' value='toggle' class='btn btn-primary'>
                  <?php if ($item['done']) { ?>
                    Undo
                  <?php } else { ?>
                    Done
                  <?php } ?>
                </button>

                <!-- Todo item delete button -->
                <button type='submit' name='action' value='delete' class='btn btn-danger'>
                  X
                </button>

              </div>
            </form>

          </div>
        <?php endforeach; ?>

      </div>

    </main>

    <!-- Bootstrap JavaScript & dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>
