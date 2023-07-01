<?php
// Maria DB 연결 설정
$servername = "localhost";
$username = "test";
$password = "1234";
$dbname = "test";

// 게시판 생성 폼이 제출되었을 때의 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 게시판 제목과 내용을 받아옴
  $title = $_POST["title"];
  $content = $_POST["content"];

  // Maria DB에 게시판 정보 저장
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Maria DB 연결 실패: " . $conn->connect_error);
  }

  $sql = "INSERT INTO boards (title, content) VALUES ('$title', '$content')";

  if ($conn->query($sql) === TRUE) {
    // 저장 성공 시 메인 페이지로 이동
    header("Location: index.html");
    exit();
  } else {
    echo "게시판 생성 실패: " . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>게시판 생성</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-top: 50px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }
    button:hover {
      background-color: #45a049;
    }
    textarea {
      resize: none; /* 높이 조절 기능 비활성화 */
      height: 400px;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 10px;
      font-size: 16px;
      width: 100%;
      box-sizing: border-box;
    }
    .board-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .board-title {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
    }
    
    .main-link {
        font-size: 14px;
        text-decoration: none;
        color: #550055;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="board-header">
        <h2 class="board-title">게시판 생성</h2>
        <a href="index.html" class="main-link">메인 화면으로 &rarr;</a>
    </div>
    <form id="create-board-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <div class="form-group">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="content">본문:</label>
        <textarea id="content" name="content" required></textarea>
      </div>
      <button type="submit">생성하기</button>
    </form>
  </div>
</body>
</html>
