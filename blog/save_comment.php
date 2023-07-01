<?php
// Maria DB 연결 설정
$servername = "localhost";
$username = "test";
$password = "1234";
$dbname = "test";

// 댓글이 제출되었을 때의 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 게시판 ID와 댓글 내용을 받아옴
  $boardId = $_POST["board_id"];
  $comment = $_POST["comment"];

  // Maria DB에 댓글 정보 저장
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Maria DB 연결 실패: " . $conn->connect_error);
  }

  $sql = "INSERT INTO comments (board_id, comment) VALUES ('$boardId', '$comment')";

  if ($conn->query($sql) === TRUE) {
    // 저장 성공 시 이전 페이지로 이동
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "댓글 작성 실패: " . $conn->error;
  }

  $conn->close();
}
?>
