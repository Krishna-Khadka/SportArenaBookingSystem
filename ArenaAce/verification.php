<?php
session_start();
    require('config.php');
   if(isset($_GET['token'])){
        $book_number = $_GET['token'];
        $query = "select book_status from arena_booking where book_number = $book_number ";
        $results = mysqli_query($con,$query);
        
        while ($row = mysqli_fetch_assoc($results))

        $status =  $row['book_status'];
        // echo $status; exit;
    
        if($status == "confirm"){
            echo "
            <script>
                alert('You have already confirm!!');
                document.location.href = 'index.php';
            </script>";
        }elseif($status== "pending"){
            $book_status = "confirm";
            $query = "update arena_booking set book_status = '$book_status' where book_number = '$book_number'";
            $result = mysqli_query($con,$query);

            if($result=true)
            {
                $sql = "UPDATE `court_cart` SET `status`='0' WHERE status=1 AND user_id = $_SESSION[id]";
                $res = mysqli_query($con,$sql);
               
                echo "
                <script>
                    alert('Your Booking has been confirm!!');
                    document.location.href = 'index.php';
                </script>";
            }else{
                echo "
                <script>
                    alert('Something went wrong!!');
                    document.location.href = 'index.php';
                </script>"; 
            }

        }

      }


?>