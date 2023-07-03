<?php
$servername = "localhost"; // 데이터베이스 서버 주소
$username = "kkkk"; // 데이터베이스 사용자 이름
$password = "1111"; // 데이터베이스 사용자 비밀번호
$dbname = "test"; // 데이터베이스 이름

// 데이터베이스 연결을 생성합니다.
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결을 확인합니다.
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 예약 정보를 가져옵니다.
$sql = "SELECT name, date, time FROM reservations";
$result = $conn->query($sql);

$reservations = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

// JSON 형식으로 예약 정보를 반환합니다.
echo json_encode($reservations);

//
