
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>게시판 상세 페이지</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-top: 50px;
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
        color: #333;
    }

    .board-content {
      margin-bottom: 20px;
      height: 400px;
    }

    .comment-section {
      margin-top: 30px;
    }

    .comment-form {
      margin-bottom: 20px;
    }

    .comment-form textarea {
      border: none;
      resize: none;
      outline: none;
      background-color: #f2f2f2;
      padding: 10px;
      width: 100%;
      height: 100px;
    }

    .comment-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .comment-item {
      margin-bottom: 10px;
      padding: 10px;
      background-color: #f2f2f2;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <?php
  // Maria DB 연결 설정
  $servername = "localhost";
  $username = "test";
  $password = "1234";
  $dbname = "test";

  // 게시판 ID를 URL 매개변수에서 가져옴
  if (isset($_GET["id"])) {
    $boardId = $_GET["id"];

    // Maria DB에서 해당 게시판 정보 가져오기
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Maria DB 연결 실패: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM boards WHERE id = $boardId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $board = $result->fetch_assoc();
      ?>
      <div class="container">
        <div class="board-header">
            <h1><?php echo $board["title"]; ?></h1>
            <a href="index.html" class="main-link">메인 화면으로</a>
        </div>
	<hr />
        <p class="board-content"><?php echo $board["content"]; ?></p>

        <div class="comment-section">
	  <hr />
          <h2>댓글 작성</h2>
          <form class="comment-form" method="POST" action="save_comment.php">
            <input type="hidden" name="board_id" value="<?php echo $boardId; ?>">
            <textarea name="comment" placeholder="댓글을 작성하세요" required></textarea>
            <br>
            <input type="submit" value="댓글 작성">
          </form>

          <h2>댓글 목록</h2>
          <ul class="comment-list">
            <?php
            // 게시판의 댓글 목록 가져오기
            $sql = "SELECT * FROM comments WHERE board_id = $boardId ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                ?>
                <li class="comment-item">
                  <p><?php echo $row["comment"]; ?></p>
                  <p><?php echo $row["created_at"]; ?></p>
                </li>
                <?php
              }
            } else {
              echo "<li>등록된 댓글이 없습니다.</li>";
            }
            ?>
          </ul>
        </div>
      </div>
      <?php
    } else {
      echo "해당 게시판을 찾을 수 없습니다.";
    }

    $conn->close();
  } else {
    echo "게시판 ID가 지정되지 않았습니다.";
  }
  ?>
</body>
</html>
