<?php 
  if(isset($_POST['book_appointment'])){
    //$book_id = $_POST['book_id'];
    $arena_id = $_POST['arena_id'];
    $user_id = $_POST['user_id'];
    $cart_no = $_POST['cart_no'];
    // $court_id = $_POST['court_id'];
    $court_cart_id = 0;
    $book_id = $user_id.time();
    //echo $book_id; exit;

    $query = "insert into arena_booking(book_number,arena_id,user_id,court_cart_id) values($book_id,$arena_id,$user_id,$court_cart_id) ";
    //echo $query; exit;
    $result = mysqli_query($con,$query);
    if($result > 0){
        header("Location: confirm_booking.php?book_id=".$book_id."&&cno=".$cart_no);
    }else{
        echo "booking failed";
    }
  }
?>