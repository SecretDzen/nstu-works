<html>
<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  .header {
    background-color: #333;
    color: #fff;
    padding: 4px;
    text-align: center;
  }

  .h1 {
    font-size: 30px;
    padding: 4px;
  }

  #app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .header {
    background-color: #333;
    color: #fff;
    padding: 4px;
    text-align: center;
  }

  .main {
    padding: 8px 4px;
    background-color: #ccc;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
  }

  .footer {
    background-color: #333;
    color: #fff;
    padding: 8px 4px;
    text-align: center;
  }

  .ckeditor {
    padding: 8px;
  }
</style>

<head>
  <title>Web - lab3 - Part 1</title>
</head>

<body>
  <div id="app">
    <header class="header">
      <h1 class="h1">Лабораторная работа №3</h1>
    </header>

    <?php
    include_once("fckeditor/fckeditor.php");
    session_start();
    ?>

    <main class="main">
      <form action="journal.php" method="post" target="_self">
        <div class="form__flags">
          <p>Оформления текста:</p>
          <div class="flex flex-row space-x-5">
            <div class="form__flags__div flex flex-col items-center">
              <p><input type="checkbox" id="cat" value="cat" name="styles[]"></P>
              <label for="cat">Котиками</label>
            </div>
            <div class="form__flags__div flex flex-col items-center">
              <p><input type="checkbox" id="dogs" value="dog" name="styles[]"></p>
              <label for="dog">Собачками</label>
            </div>
            <div class="form__flags__div flex flex-col items-center">
              <p><input type="checkbox" id="turtle" value="turtle" name="styles[]"></p>
              <label for="turtle">Черепахами</label>
            </div>
          </div>
        </div>
        <br>

        <p>Комментарий: </p>
        <div id="ckeditor" class="ckeditor">
          <?php
          $oFCKeditor = new FCKeditor('comment');
          $oFCKeditor->BasePath = 'fckeditor/';
          $oFCKeditor->Value = '';
          $oFCKeditor->Create();
          ?>
        </div>
        <div>
          <label for="username">Имя: </label>
          <input name="username" required placeholder="Ваше имя..." />
        </div>
        <img src="/web/lab3/kcaptcha/index.php?<?php echo session_name() ?>=<?php echo session_id() ?>"></p>
        <div>
          <label for="code">Код подтверждения: </label>
          <input name="code" required placeholder=" " />
        </div>
        <button>Отправить</button>
      </form>
    </main>

    <footer class="footer">
      <p>Лабораторные выполнил студент АВТ-019 - Попов П.С.</p>
      <p>Вариант №8</p>
    </footer>
  </div>
</body>

</html>