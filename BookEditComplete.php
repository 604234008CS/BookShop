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
$book = $statement->fetch(PDO::FETCH_OBJ);
?>

<?php require 'header.php'; ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header w3-text-gray">
        <h2>ข้อมูลหนังสือ</h2>
    </div>
    <div class="card-body">
    <div class="row">
        <div class="col w3-text-gray">
            <p>ชื่อหนังสือ</p>
        </div>
        <div class="col-10">
            <p><?= $book->BookName; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>ผู้แต่ง</p>
        </div>
        <div class="col-10">
            <p><?= $book->AuthorName; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>ประเภทหนังสือ</p>
        </div>
        <div class="col-10">
            <p><?= $book->CategoryName; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>สำนักพิมพ์</p>
        </div>
        <div class="col-10">
            <p><?= $book->PublisherName; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>คำอธิบาย</p>
        </div>
        <div class="col-10">
            <p><?= $book->BookDescription; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>ราคา</p>
        </div>
        <div class="col-10">
            <p><?= $book->BookPrice; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>สถานะการขาย</p>
        </div>
        <div class="col-10">
            <p><?= $book->StatusName; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>ISBN</p>
        </div>
        <div class="col-10">
            <p><?= $book->BookISBN; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col w3-text-gray">
            <p>จำนวนหน้า</p>
        </div>
        <div class="col-10">
            <p><?= $book->BookNumPages; ?></p>
        </div>
    </div>
    <div class="form-group" align="center">
           <a href="BookList.php" class='btn w3-green'>กลับหน้าแรก</a>
        </div>
    
      
    </div>
  </div>
</div>




<?php require 'footer.php'; ?>
