<div id="endora" style="display: none">
  <endora>
</div>
<link rel="stylesheet" href="../css/new.css">
<?php
include("menu.php");
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
if (isset($_POST['input'])) {
  include "db.php";


  // Create connection
  $conn = new mysqli($servername, $username, $password, $DBName);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  function gen_uid($len = 10)
  {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $len);
  }
  $usr = gen_uid(5);
  $url = $_POST['input'];
  $timestamp = date("Y-m-d H:i:s");

  $sqlquery = "SELECT * FROM userurl WHERE url = '$url'";
  $result = $conn->query($sqlquery);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $usr = $row['usr'];
      break;
    }
    $conn->query($sqlquery);
  } else {
    $sqlquery = "INSERT INTO userurl (id, usr, url, date) VALUES (NULL, '$usr', '$url', '$timestamp') ";
    if ($conn->query($sqlquery) === TRUE) { } else {
      echo "Error: " . $sqlquery . "<br>" . $conn->error;
    }
    file_get_contents("https://hook.integromat.com/oweeywuc9rhi5qgaw6dxa3r7ehlqas1y?usr=" . $usr . "&url=" . $url);
  }

  $conn->close();
}
?>
<div id="fullscreen">
  <div class="fullscreen-content">

    <div class="title">
      <?php
      if (isset($_POST['input'])) {
        echo '<p><span id="url" class="url">' . $url . '</span><br><br> was saved as</p>  <h1>' . $usr . '</h1><div id="embed"> </div>';
      } else {
        echo '<h1 class="errheader"><span>4</span>&nbsp;<span>0</span>&nbsp;<span>0</span> </h1><br> <span id="errcode">bad request</span>';
      }

      ?>
      <script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.2.1/dist/jquery.min.js"> </script>
      <script src="https://cdn.jsdelivr.net/gh/filiptronicek/Embed/embed.js"> </script>
      <script>
        Embed($("#url").text());
      </script>

    </div>
  </div>