<?php
// MariaDB 연결 설정
$servername = 'localhost'; // 호스트 이름
$username = 'kkkk'; // 사용자 이름
$password = '1111'; // 비밀번호
$dbname = 'test'; // 데이터베이스 이름

// MariaDB 연결
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('MariaDB 연결 실패: ' . $conn->connect_error);
}

// 게시판 목록 가져오기 쿼리 실행
$sql = 'SELECT * FROM boards ORDER BY created_at DESC';
$result = $conn->query($sql);

$boards = array();

// 쿼리 결과 처리
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $board = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'content' => $row['content'],
            'created_at' => $row['created_at']
        );
        array_push($boards, $board);
    }
}

// 결과를 JSON 형태로 반환
header('Content-Type: application/json');
echo json_encode($boards);

// 연결 종료
$conn->close();
?>
