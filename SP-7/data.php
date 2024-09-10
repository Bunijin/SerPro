<?php
// data.php

// Function to safely get POST data
function getPostData($key) {
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
}

// Output HTML structure and include CSS
echo '<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการสมัครสมาชิกสมาคมโรคหลอดเลือดสมองไทย</title>
    <link rel="stylesheet" href="data.css">
</head>
<body>
<div class="container">';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h1>ข้อมูลการสมัครสมาชิกสมาคมโรคหลอดเลือดสมองไทย</h1>";
    
    // Personal Information
    echo "<section>";
    echo "<h2>ข้อมูลส่วนตัว</h2>";
    echo "<p><strong>ชื่อ-นามสกุล:</strong> " . getPostData('fnameth') . " " . getPostData('lnameth') . "</p>";
    echo "<p><strong>Name-Surname:</strong> " . getPostData('fnameen') . " " . getPostData('lnameen') . "</p>";
    echo "<p><strong>วันเดือนปีเกิด:</strong> " . getPostData('birthdate') . "</p>";
    echo "<p><strong>ตำแหน่งหรือยศ:</strong> " . getPostData('position') . "</p>";
    echo "</section>";

    // Home Address
    echo "<section>";
    echo "<h2>ที่อยู่บ้าน</h2>";
    echo "<p>เลขที่ " . getPostData('house-address') . " หมู่ที่ " . getPostData('muu') . 
         " ซอย " . getPostData('soi') . " ถนน " . getPostData('road') . "</p>";
    echo "<p>แขวง/ตำบล " . getPostData('tumbon') . " เขต/อำเภอ " . getPostData('district') . 
         " จังหวัด " . getPostData('province') . " รหัสไปรษณีย์ " . getPostData('postal-code') . "</p>";
    echo "<p><strong>โทรศัพท์:</strong> " . getPostData('phone-number') . 
         " <strong>โทรสาร:</strong> " . getPostData('fax-number') . 
         " <strong>มือถือ:</strong> " . getPostData('mobile-number') . "</p>";
    echo "<p><strong>E-mail:</strong> " . getPostData('email') . "</p>";
    echo "</section>";

    // Work Address
    echo "<section>";
    echo "<h2>ที่ทำงาน</h2>";
    echo "<p>เลขที่ " . getPostData('work-adress') . " หมู่ที่ " . getPostData('muu2') . 
         " ซอย " . getPostData('soi2') . " ถนน " . getPostData('road2') . "</p>";
    echo "<p>แขวง/ตำบล " . getPostData('tumbon2') . " เขต/อำเภอ " . getPostData('district2') . 
         " จังหวัด " . getPostData('province2') . " รหัสไปรษณีย์ " . getPostData('postal-code2') . "</p>";
    echo "<p><strong>โทรศัพท์:</strong> " . getPostData('phone-number2') . 
         " <strong>โทรสาร:</strong> " . getPostData('fax-number2') . "</p>";
    echo "</section>";

    // Qualifications and Membership
    echo "<section>";
    echo "<h2>คุณสมบัติและประเภทสมาชิก</h2>";
    echo "<p><strong>คุณวุฒิ:</strong> " . getPostData('qualification') . "</p>";
    echo "<p><strong>เลขใบประกอบวิชาชีพเวชกรรม:</strong> " . getPostData('medical-certificate') . "</p>";
    echo "<p><strong>ประเภทสมาชิก:</strong> " . getPostData('member') . "</p>";
    echo "<p><strong>ประเภทสมาชิกสมทบ:</strong> " . getPostData('member-addon') . "</p>";
    echo "</section>";

    // Payment Information
    echo "<section>";
    echo "<h2>ข้อมูลการชำระเงิน</h2>";
    echo "<p><strong>ประเภทการชำระ:</strong> " . getPostData('money') . "</p>";
    echo "<p><strong>จำนวนเงินสด:</strong> " . getPostData('cash1') . " บาท</p>";
    echo "<p><strong>จำนวนเงินเช็ค:</strong> " . getPostData('cash2') . " บาท</p>";
    echo "</section>";

    // Signatures and Dates
    echo "<section>";
    echo "<h2>ลายเซ็นและวันที่</h2>";
    echo "<p><strong>ลงชื่อผู้รับเงิน:</strong> " . getPostData('signature-recieve') . " (" . getPostData('sig1') . ") วันที่ " . getPostData('day1') . "</p>";
    echo "<p><strong>ลงชื่อผู้สมัคร:</strong> " . getPostData('signature-signup') . " (" . getPostData('sig2') . ") วันที่ " . getPostData('day2') . "</p>";
    echo "</section>";

    // Official Use
    echo "<section>";
    echo "<h2>สำหรับเจ้าหน้าที่</h2>";
    echo "<p><strong>ประเภทสมาชิกที่ได้รับ:</strong> " . getPostData('member-type') . "</p>";
    echo "<p><strong>นายทะเบียน:</strong> " . getPostData('registrar') . "</p>";
    echo "<p><strong>นายกสมาคม/เลขาธิการ:</strong> " . getPostData('association') . "</p>";
    echo "</section>";

} else {
    echo "<p>ไม่มีข้อมูลการสมัครที่ส่งมา กรุณากรอกแบบฟอร์มและส่งข้อมูล</p>";
}

echo '</div></body></html>';
?>