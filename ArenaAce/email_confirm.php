 <?php 
//    session_start();
//    session_regenerate_id(true);

   if(isset($_SESSION['USER'])){
    $info = $_SESSION['USER'];
    $user_id = $info['id'];
   }

   $book_number = $_GET['book_id'];
   //echo $book_number;
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
+
   require "assets/phpmailer/Exception.php";
   require "assets/phpmailer/PHPMailer.php";
   require "assets/phpmailer/SMTP.php";

   if(isset($_POST['confirm_booking']))
   {
       $email = $_POST['email'];
       $book_no = $_POST['book_no'];
       $cart_no = $_POST['cart_no'];

    //    echo $book_no." ".$cart_no.'<br>' ;

       $sql = "select * from court_cart where cart_number = $cart_no ";
       $result = mysqli_query($con,$sql);

    //    $cn = [];
       while ($row = mysqli_fetch_assoc($result)) {
          $cn = $row['cart_number'];
          $court_id = $row['court_id'];
          $date = $row['date'];
          $time = $row['time'];

          $rowData = array(
            'cart_number' => $cn,
            'court_id' => $court_id,
            'date' => $date,
            'time' => $time
        );
    
        // Add the associative array to the main array
        $dataArray[] = $rowData;
       }

      
    //    print_r($dataArray);
    //    exit;

       $mail = new PHPMailer(true);
       $mail->isSMTP();

       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'chrisparajuli@gmail.com'; // your email
       $mail->Password = 'mibskhgslpvdvwbl'; // gmail app password

       // $mail->Username = 'globalengineering@ujwalkoirala.com.np'; // your email
       // $mail->Password = 'XD2kQybe@2+Z'; // gmail app password

       $mail->SMTPSecure = 'ssl';
       $mail->Port = 465;

       $fromName = "Arena Ace";
       $mail->setFrom("chrisparajuli@gmail.com",$fromName);
       // $mail->setFrom("globalengineering@ujwalkoirala.com.np",$fromName);
       $mail->addAddress($email,$fromName);
       $mail->addReplyTo('chrisparajuli@gmail.com',$fromName);
       // $mail->addBCC('chrisparajuli@gmail.com',$fromName);
       $mail->isHTML(true);

       $subject = "Please confirm your email subscription";
                   //message start
                   
                   $message='<img src="ROOT/assets/images/logo2.png" alt="">
                   <h1 style="text-align:center;">'.$fromName.'</h1> 
                   <p style="font-size:16px;text-align:center;">We have sent an confirmation email. <a href="http://localhost/Project_Sports/ArenaAce/verification.php?token='.$book_number.'">Click Here </a> to confirm your Booking 
                   <br><br>
                   OR
                   <br>
                   All rights reserved || '.$fromName.'</p>';

       $mail->Subject = $subject;
       $mail->Body = $message;
//    <a target="_blank" href="'.ROOT.'/unsubscribe?token='.$token.'" ><small><u>Unsubscribe </small></u></a>
       $status = $mail->send();

       if($status)
       {

            for ($i = 0; $i < count($dataArray); $i++) {
                $cn = $dataArray[$i]['cart_number'];
                $court_id = $dataArray[$i]['court_id'];
                $date = $dataArray[$i]['date'];
                $time = $dataArray[$i]['time'];

                $update = "update time_slots set isBooked = 1 where date = '$date' and time = '$time' and court_id = $court_id ";
                $updateTime = mysqli_query($con,$update);
            }

            $courtCart = "update court_cart set status = 0 where cart_number = '$cart_no' ";
            $updateCart = mysqli_query($con,$courtCart);

            unset($_SESSION['CN']);

           echo "
           <script>
               alert('A Conformation code has been send to your email. Please check and confirm your Booking');
               document.location.href = 'index.php';
           </script>";
       }else{
           echo "
           <script>
               alert('Mail not  sent successfully');
               document.location.href = 'index.php';
           </script>";
       }
   }

?>