<?php
  if(isset( $_POST['name']))
  $name = $_POST['name'];
  if(isset( $_POST['email']))
  $email = $_POST['email'];
  if(isset( $_POST['message']))
  $message = $_POST['message'];
  if(isset( $_POST['subject']))
  $subject = $_POST['subject'];
  header('Content-Type: application/json');
  if ($name === '') {
    print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
    exit();
  }
  if ($email === '') {
    print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
    exit();
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
      exit();
    }
  }
  if ($subject === '') {
    print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
    exit();
  }
  if ($message === '') {
    print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
    exit();
  }

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require './PHPMailer-master/src/Exception.php';
  require './PHPMailer-master/src/PHPMailer.php';
  require './PHPMailer-master/src/SMTP.php';

  $mail = new PHPMailer(true);
  try {
  //Server settings
  $mail->SMTPDebug = 2;
  $mail->isSMTP(); // Sử dụng SMTP để gửi mail
  $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
  $mail->SMTPAuth = true; // Bật xác thực SMTP
  $mail->Username = 'duckg2083@gmail.com'; // Tài khoản email
  $mail->Password = 'fdel nmkf sobl fqio'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
  $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
  $mail->Port = 465; // Cổng kết nối SMTP là 465

  //Recipients
  $mail->setFrom($email, $name); // Địa chỉ email và tên người gửi
  $mail->addAddress('duckg2083@gmail.com', 'Tony'); // Địa chỉ mail và tên người nhận

  //Content
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = $subject; // Tiêu đề
  $mail->Body = $message; // Nội dung

  $mail->send();
  echo 'Message has been sent';
  } catch (Exception $e) {
  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;}
  exit();
?>