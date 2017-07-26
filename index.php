<?php 

    // Message Vars
    $msg = '';
    $msgClass = '';
    // Check Submit

   if (filter_has_var(INPUT_POST, 'submit')) {
      // Get Form Data
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      // Check Required Fields
      if (!empty($email) && !empty($name) && !empty($message)) {
        // Passed
        
        // Check Email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            // Failed
            $msg = 'Please fill email field';
            $msgClass = 'alert-danger';
        } else {
            // Passed
            // Recipient Email
            $toEmail = 'yourEmail@gmail.com';
            $subject = 'Contact Request From ' . $name;
            $body = '<h2>Contact Request</h2>
                    <h4>Name:</h4><p>' . $name . '</p>
                    <h4>Email:</h4><p>' . $email . '</p>
                    <h4>Message:</h4><p>' . $message . '</p>';

            // Email Headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

            // Additional Headers
            $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";
                
            if (mail($toEmail, $subject, $body, $headers)) {
                // Email Send
                $msg = 'Your Email has been send!';
                $msgClass = 'alert-success';
            } else {
                // Email Send
                $msg = 'Your Email was not send!';
                $msgClass = 'alert-danger';
            }
        }
    } else {
        // Failed
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Contact Us</title>
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF']?>">My Website</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center page-header well">Contact Us</h2>

        <div class="row">
            <?php if ($msg != '') : ?>
                <div class="alert <?php echo $msgClass; ?>"><?= $msg; ?></div>
            <?php endif; ?>
            <form class="col-sm-8 col-sm-offset-2" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?= !empty($_POST['name']) ? $_POST['name'] : ''; ?>" class="form-control" placeholder="Enter Your Name ..." />
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"id="email" name="email" value="<?= !empty($_POST['email']) ? $_POST['email'] : ''; ?>" class="form-control" placeholder="Enter Your Email ..." />
                </div>                

                <div class="form-group">
                    <label for="message">Massage</label>
                    <textarea rows="7" id="message" class="form-control" name="message" placeholder="Your Message ..."><?= !empty($_POST['message']) ? $_POST['message'] : ''; ?>
                    </textarea>
                </div>

                <div class="form-group">
                    <button type="submit"name="submit" class="btn btn-primary btn-block">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>