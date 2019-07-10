<?php
// define variables and set to empty values
$to = "youremail@example.com";
$type = $name = $tel = $email = $mailCheck = $message = "";
$typeErr = $nameErr = $emailErr = $mailcheckErr = $messageErr = $messageStatus = $tryAgainButton = "";

//Protect input values from malicious code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $type = $_POST["type"];
  $name = test_input($_POST["name"]);
  $tel = test_input($_POST["tel"]);
  $email = test_input($_POST["email"]);
  $mailCheck = test_input($_POST["mailCheck"]);
  $message = test_input($_POST["message"]);
  $confirmed = $_POST["confirmed"];
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Error messages
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["type"])) {
    $typeErr = "* Type is required.";
  } else {
    $type = test_input($_POST["type"]);
  }

  if (empty($_POST["name"])) {
    $nameErr = "* Name is required.";
  } else {
    $name = test_input($_POST["name"]);
  }

  $tel = test_input($_POST["tel"]);

  if (empty($_POST["email"])){
    $emailErr = "* An email address is required.";
  } else if ($email != $mailCheck) {
    $emailErr = "Email addresses must match.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // check if e-mail address is well-formed
    $emailErr = "* Invalid email format";
  } else {
    $email = test_input($_POST["email"]);
  }
}

if (empty($_POST["message"])) {
  $messageErr = "* A message is required.";
} else {
  $message = test_input($_POST["message"]);
}

$page_flag = 0;
// Check input values and send if everything is cool.
if ( empty($name) || empty($email) || !filter_var($email) || empty($message) ) {
  $messageStatus = "Please check that every box has been completed and that the email address entered is valid.";
} else {
  $page_flag = 1;
}

// mail send
if($page_flag == '1' && $confirmed == 'true') {
  mail($to,'Test',$message,$email);
  $page_flag = 2;
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>GFTD CAFE & BAR</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/nav_style.css">
  <link rel="stylesheet" href="css/access.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

  <script type="text/javascript">
    function submitForm() {
      alert("<?= $messageStatus ?><?= $nameErr ?><?= $emailErr ?><?= $messageErr ?>");
    }
  </script>

</head>

<body>
  <?php include('navigation.html') ?>

  <div class="accesswrapper">

    <div class="map">
      <img src="img/map.png" alt="">
    </div>

    <div class="contactDetails">
      <table>
        <tr>
          <td>
            <p><i class="fas fa-map-marker-alt"></i></p>
          </td>
          <td>
            <p>〒000-0000 東京都なんとか区なんとか町なんとかビルB1F</p>
          </td>
        </tr>
        <tr>
          <td>
            <p><i class="far fa-clock"></i></p>
          </td>
          <td>
            <p>DAILY : 11 am - 11 pm</p>
          </td>
        </tr>
        <tr>
          <td>
            <p><i class="fas fa-phone"></i></p>
          </td>
          <td>
            <p>TEL : <a href="tel:00-0000-0000">00-0000-0000</a></p>
          </td>
        </tr>
        <tr>
          <td>
            <p><i class="fas fa-fax"></i></p>
          </td>
          <td>
            <p>FAX : 00-0000-0000</p>
          </td>
        </tr>
      </table>
    </div>

    <div id="contactForm" class="contactForm">
      <div class="header">
        <h1>Contact</h1>
      </div>
      <?php if($page_flag == 0): ?>
        <form action="#contactForm" method="post">
          <p>お問い合わせの種類※必須</p>
          <select class="type" name="type">
            <option value="">パーティー</option>
            <option value="">イベント</option>
            <option value="">貸切</option>
            <option value="">プロモーション</option>
            <option value="">その他</option>
          </select>
          <p>お名前※必須</p>
          <input type="text" name="name" placeholder="お名前" value="<?php if( !empty($name) ){ echo $name; } ?>">
          <p>お電話番号</p>
          <input type="tel" name="tel" placeholder="お電話番号" value="<?php if( !empty($tel) ){ echo $tel; } ?>">
          <p>メールアドレス ※必須</p>
          <input type="email" name="email" placeholder="メールアドレス" value="<?php if( !empty($email) ){ echo $email; } ?>">
          <p>メールアドレス(確認) ※必須</p>
          <input type="email" name="mailCheck" placeholder="メールアドレス">
          <p>お問い合わせ内容※必須</p>
          <input type="text" name="message" placeholder="お問い合わせ内容" value="<?php if( !empty($message) ){ echo $message; } ?>"><br>
          <input id="submit" type="submit" placeholder="submit" value="内容を確認する" >
        </form>
      <?php elseif($page_flag == 1): ?>
        <form action="#contactForm" method="post">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="hidden" name="tel" value="<?php echo $tel; ?>">
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          <input type="hidden" name="message" value="<?php echo $message; ?>">
          <input type="hidden" name="confirmed" value="true">
          <div>
            <label>お名前</label>
            <p><?php echo $name; ?></p>
          </div>

          <div>
            <label>メールアドレス</label>
            <p><?php echo $email; ?></p>
          </div>

          <div>
            <label>電話番号</label>
            <p><?php echo $tel; ?></p>
          </div>

          <div>
            <label>お問い合わせ内容</label>
            <p><?php echo $message; ?></p>
          </div>
          <input type="button" value="内容を修正する" onclick="history.back(-1)">
          <button type="submit" name="submit">送信する</button>
        </form>
      <?php else: ?>
        <p>thanks!</p>
      <?php endif ?>
    </div>
  </div>

  <?php include('footer.html') ?>
</body>

</html>
