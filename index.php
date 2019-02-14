<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
  <?php if ($_GET['message']): ?>
    <div class="message">
      <span class="close" onclick="closeMessage()">X</span>
      <?= $_GET['message'] ?>
    </div>
  <?php endif ?>
  <form action="./controller/reader.php" method="POST" enctype="multipart/form-data">
    <div class="box">
      <label for="fileToUpload">Clique aqui para selecionar o arquivo</label>
      <div class="file-name"></div>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <div class="box">
      <input type="submit" value="Baixar Imagens" id="btn-download" name="submit">
    </div>
  </form>
  <div class="preloader">
    <div>Baixando</div>
    <span class="line line-1"></span>
    <span class="line line-2"></span>
    <span class="line line-3"></span>
    <span class="line line-4"></span>
    <span class="line line-5"></span>
    <span class="line line-6"></span>
    <span class="line line-7"></span>
    <span class="line line-8"></span>
    <span class="line line-9"></span>
  </div>
  <script>
    window.onload = function(){
      document.querySelector('#btn-download').
      addEventListener("click", function(){
        document.querySelector('.preloader').style.display = 'block';
      });

      document.querySelector('#fileToUpload').
      addEventListener("change", function(event){
        event         = event || window.event;
        var target    = event.target || event.srcElement;
        var fileName  = ((stringBroken = target.value.split('\\'))[stringBroken.length-1]);
        document.querySelector('form .file-name').innerText = fileName;
      });
    }

    function closeMessage(event){
      event       = event || window.event;
      var target  = event.target || event.srcElement;
      target.parentNode.style.display = 'none';
    }
  </script>
</body>
</html>