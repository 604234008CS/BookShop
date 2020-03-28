<?php
require 'db.php';
$sql = 'SELECT * FROM books, authors, categories, publishers, status 
WHERE books.AuthorID = authors.AuthorID
AND books.CategoryID = categories.CategoryID
AND books.PublisherID = publishers.PublisherID
AND books.BookStatus = status.BookStatus';
$statement = $connection->prepare($sql);
$statement->execute();
$book = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<?php require 'header.php'; ?>

<div class="container-fluid">
  <div class="card mt-5">
    <div class="card-header w3-text-gray row">
    <div class="col-md-4"> <h2>ข้อมูลหนังสือ</h2> </div>
    <div class="col-md-1 ml-auto"> <a href="BookAdd.php" class='btn w3-green'>เพิ่มหนังสือ</a> </div>
      
      <div align="right">
        
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <tr class="w3-pale-green">
          <th>ชื่อหนังสือ</th>
          <th>ชื่อผู้แต่ง</th>
          <th>ประเภทหนังสือ</th>
          <th>สำนักพิมพ์</th>
          <th>ราคา</th>
          <th>สถานะการขาย</th>
          <th></th>
        </tr>
        <?php foreach($book as $books): ?>
          <tr>
            
             <!-- สร้างใชื่อห้เหมือนในฐานข้อมูล -->
            <td><?= $books->BookName; ?></td> 
            <td><?= $books->AuthorName; ?></td> 
            <td><?= $books->CategoryName; ?></td> 
            <td><?= $books->PublisherName; ?></td> 
            <td><?= $books->BookPrice; ?></td> 
            <td><?= $books->StatusName; ?></td>   
            <td>
              <a href="BookEdit.php?id=<?= $books->BookId ?>" class="btn w3-indigo">แก้ไข</a>
              <a onclick="return confirm('ต้องการลบหรือไม่?')" 
              href="BookDelete.php?id=<?= $books->BookId ?>" class='btn w3-red'>ลบ</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>




<?php require 'footer.php'; ?>
