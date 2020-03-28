<?php
require 'db.php';

if (isset($_POST['BookName']) && isset($_POST['CategoryID']) && isset($_POST['AuthorID']) && isset($_POST['PublisherID']) && isset($_POST['BookDescription']) && isset($_POST['BookPrice']) && isset($_POST['BookNumPages']) && isset($_POST['BookISBN']) && isset($_POST['BookStatus'])){
    $BookName = $_POST['BookName'];
    $CategoryID = $_POST['CategoryID']; 
    $AuthorID = $_POST['AuthorID']; 
    $PublisherID = $_POST['PublisherID']; 
    $BookDescription = $_POST['BookDescription']; 
    $BookPrice = $_POST['BookPrice']; 
    $BookNumPages = $_POST['BookNumPages']; 
    $BookISBN = $_POST['BookISBN']; 
    $BookStatus = $_POST['BookStatus']; 
    $sql = "INSERT INTO books(BookName, CategoryID, AuthorID, PublisherID, BookDescription, BookPrice, BookNumPages, BookISBN, BookStatus)
    VALUES('$BookName, '$CategoryID', '$AuthorID', '$PublisherID', '$BookDescription', '$BookPrice', '$BookNumPages', '$BookISBN', '$BookStatus')";
    $statement = $connection->prepare($sql);
    if($statement->execute())   {
        header("Location: BookList.php");
    }
}
?>

<?php require 'header.php'; ?>

<div class="container">
  <div class = "card mt-4">
    <div class = "card-header w3-text-gray">
    <h2>เพิ่มหนังสือ</h2>
    </div>
    <div class = "card-body">
    <?php if(!empty($message)): ?>
    <div class = "alert alert-success">
    <?= $message; ?>
    </div>
    <?php endif; ?>

      <form method="post">        
        <div class="form-group">
          <label for="">ชื่อหนังสือ</label>
          <input type="text" name="BookName" id="BookName" class="form-control" ></div>
        <div class="form-group"> 
          <label for="">ประเภทหนังสือ</label>
          <select name="CategoryID" id="CategoryID" class="form-control" >
              <option value="">---ประเภทหนังสือ---</option>
              <option value="1">นิยาย</option>
              <option value="2">จิตวิทยา/พัฒนาตนเอง</option>
              <option value="3">อาหารและสุขภาพ</option>
          </select></div>
        <div class="form-group"> 
          <label for="">ผู้แต่ง</label>
          <select name="AuthorID" id="AuthorID" class="form-control" >
              <option value="">---ผู้แต่ง---</option>
              <option value="1">Haruki Murakami</option>
              <option value="2">Malcolm Gladwell</option>
              <option value="3">Meg Jay</option>
              <option value="4">นายแพทย์จางเหวินหง</option>
              <option value="5">Charles Duhigg</option>
              <option value="6">Higashino Keigo</option>
              <option value="7">Matthew Walker</option>
          </select></div>
        <div class="form-group"> 
          <label for="">สำนักพิมพ์</label>
          <select name="PublisherID" id="PublisherID" class="form-control" >
              <option value="">---สำนักพิมพ์---</option>
              <option value="1">สำนักพิมพ์กำมะหยี่</option>
              <option value="2">สำนักพิมพ์วีเลิร์น</option>
              <option value="3">สำนักพิมพ์ Amarin Health</option>
              <option value="4">น้ำพุสำนักพิมพ์</option>
              <option value="5">บุ๊คสเคป</option>
          </select></div>
        <div class="form-group">
          <label for="">คำอธิบาย</label>
          <textarea type="text" name="BookDescription" id="BookDescription" row="3" class="form-control" > 
          </textarea></div>
        <div class="form-group">
          <label for="">ราคา</label>
          <input type="text" name="BookPrice" id="BookPrice" class="form-control" ></div>
        <div class="form-group">
          <label for="">จำนวนหน้า</label>
          <input type="text" name="BookNumPages" id="BookNumPages" class="form-control" ></div>
        <div class="form-group">
          <label for="">ISBN</label>
          <input type="text" name="BookISBN" id="BookISBN" class="form-control" ></div>
        <div class="form-group">
          <label for="">สถานะการขาย</label><br>
          <input value="1" checked type="radio" name="BookStatus" id="BookStatus">&nbsp;ปกติ&nbsp;
          <input value="0" type="radio" name="BookStatus" id="BookStatus">&nbsp;เลิกจำหน่าย      
          </div>   
        <div class="form-group" align="center">
           <button type="submit" class="btn w3-green">บันทึก</button>
           <a onclick="return confirm('ต้องการยกเลิกหรือไม่?')" 
              href="BookList.php" class='btn w3-red'>ยกเลิก</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>