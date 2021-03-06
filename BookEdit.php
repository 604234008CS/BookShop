<?php
require 'db.php';

$BookId = $_GET['id'];
$sql = 'SELECT * FROM books, authors, categories, publishers, status 
WHERE BookId=?
AND books.AuthorID = authors.AuthorID
AND books.CategoryID = categories.CategoryID
AND books.PublisherID = publishers.PublisherID
AND books.BookStatus = status.BookStatus';
$statement = $connection->prepare($sql);
$statement->execute([$BookId]);
$books = $statement->fetch(PDO::FETCH_OBJ);

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
    $sql = "UPDATE books SET BookName=?, CategoryID=?, AuthorID=?, PublisherID=?, BookDescription=?, BookPrice=?, BookNumPages=?, BookISBN=?, BookStatus=? 
    WHERE BookId=?";
    $statement = $connection->prepare($sql);
    if($statement->execute([$BookName, $CategoryID, $AuthorID, $PublisherID, $BookDescription, $BookPrice, $BookNumPages, $BookISBN, $BookStatus, $BookId]))   {
        header("Location: BookEditComplete.php?id={$books->BookId}");
    }
}
?>

<?php require 'header.php'; ?>

<div class="container">
  <div class = "card mt-4">
    <div class = "card-header w3-text-gray">
    <h2>ข้อมูลหนังสือ</h2>
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
          <input value="<?= $books->BookName; ?>" type="text" name="BookName" id="BookName" class="form-control" required></div>
        <div class="form-group"> 
          <label for="">ประเภทหนังสือ</label>
          <select value="<?= $books->CategoryID; ?>" name="CategoryID" id="CategoryID" class="form-control" required>
              <option value="<?= $books->CategoryID; ?>"><?= $books->CategoryName; ?></option>
              <option value="">---ประเภทหนังสือ---</option>
              <option value="1">นิยาย</option>
              <option value="2">จิตวิทยา/พัฒนาตนเอง</option>
              <option value="3">อาหารและสุขภาพ</option>
          </select></div>
        <div class="form-group"> 
          <label for="">ผู้แต่ง</label>
          <select value="<?= $books->AuthorID; ?>" name="AuthorID" id="AuthorID" class="form-control" required>
              <option value="<?= $books->AuthorID; ?>"><?= $books->AuthorName; ?></option>
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
          <select value="<?= $books->PublisherID; ?>" name="PublisherID" id="PublisherID" class="form-control" required>
              <option value="<?= $books->PublisherID; ?>"><?= $books->PublisherName; ?></option>
              <option value="">---สำนักพิมพ์---</option>
              <option value="1">สำนักพิมพ์กำมะหยี่</option>
              <option value="2">สำนักพิมพ์วีเลิร์น</option>
              <option value="3">สำนักพิมพ์ Amarin Health</option>
              <option value="4">น้ำพุสำนักพิมพ์</option>
              <option value="5">บุ๊คสเคป</option>
          </select></div>
        <div class="form-group">
          <label for="">คำอธิบาย</label>
          <textarea type="text" name="BookDescription" id="BookDescription" class="form-control" required>
            <?= $books->BookDescription; ?>"
          </textarea></div>
        <div class="form-group">
          <label for="">ราคา</label>
          <input value="<?= $books->BookPrice; ?>" type="text" name="BookPrice" id="BookPrice" class="form-control" required></div>
        <div class="form-group">
          <label for="">จำนวนหน้า</label>
          <input value="<?= $books->BookNumPages; ?>" type="text" name="BookNumPages" id="BookNumPages" class="form-control" required></div>
        <div class="form-group">
          <label for="">ISBN</label>
          <input value="<?= $books->BookISBN; ?>" type="text" name="BookISBN" id="BookISBN" class="form-control" required></div>
        <div class="form-group">
          <label for="">สถานะการขาย</label><br>
          <input value="1" <?= ($books->BookStatus == "1" ?'checked="checked"': '') ; ?> type="radio" name="BookStatus" id="BookStatus">&nbsp;ปกติ&nbsp;
          <input value="0" <?= ($books->BookStatus == "0" ?'checked="checked"': '') ; ?> type="radio" name="BookStatus" id="BookStatus">&nbsp;เลิกจำหน่าย      
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