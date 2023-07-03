<?php
$servername = "localhost"; // 데이터베이스 서버 주소
$username = "kkkk"; // 데이터베이스 사용자 이름
$password = "1111"; // 데이터베이스 사용자 비밀번호
$dbname = "test"; // 데이터베이스 이름

// POST 요청으로부터 예약 정보를 가져옵니다.
$name = $_POST['name'];
$date = $_POST['date'];
$time = $_POST['time'];

// 데이터베이스 연결을 생성합니다.
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결을 확인합니다.
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 예약 정보를 데이터베이스에 삽입합니다.
$sql = "INSERT INTO reservations (name, date, time) VALUES ('$name', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
 // 예약이 성공적으로 저장되었을 때 index.html로 리다이렉트합니다.
    header("Location: index.html");
    exit();
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결을 종료합니다.
$conn->close();
?>
