<?php
    // Message Vars
    $msg = '';
    $msgClass = '';

    // Check For Submit
    if(filter_has_var(INPUT_POST, 'submit')){
        //echo 'Submitted' ;
    
        // Get Form Data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Check required field
        if((!empty($name)) && (!empty($email)) && (!empty($message)) ){
            // Passed
            echo 'Field Passed<br>';
            // Check if email is valid
            if((filter_var($email, FILTER_VALIDATE_EMAIL) === false)){
            // Failed
                $msg = 'Email is NOT valid';
                $msgClass = 'alert-danger';
            }else {
            // Passed
                //echo 'Email is valid<br>'; 
                // Recepient Email 
                $toEmail = 'mgptxg.awmgdtwadmd@gmail.com'; 
                $subject = 'Contact Request From '. $name; 
                $body = '<h1></h1> 
                <h5>Name</h5><p></p> 
                <h5>Email</h5><p></p> 
                <h5>Message</h5><p></p> 
                ';
                                
                // Email Headers 
                $headers = "MINE-Version: 1.0" . "\r" ;  
                // $headers = $headers . "Content..." 
                $headers.= "Content-Type:text/html;charset=UTF-8" . "\r";

                // Additional Headers
                $headers.= "From: " . $name . "<" . $email . ">" . "\r";
                if(mail($toEmail, $subject, $body, $headers)){
                    $msg = 'Message successfully sent';
                    $msgClass = 'alert-success';
                }else{
                    $msg = 'Message not sent';
                    $msgClass = 'alert-danger';                
                }
            }
        } else{
            // Failed 
            $msg = 'Please fill up all fields'; 
            $msgClass = 'alert-danger'; // red message shows up
        }
    }
 ?>
 
 <!DOCTYPE html> 
 <html> 
 <head>
    <title>Constact Us</title>
    <link rel = "stylesheet" href = "https://bootswatch.com/4/cyborg/bootstrap.min.css"> 
</head> 
<body>
    <nav class = "navbar navbar-default">
        <div class = "container">
            <div class = "navbar-header">
                <a class = "navbar-brannd" href = "index.php">My Website</a> 
            </div> 
        </div>
    </nav> 
    <div class = "container"> 
        <?php if($msg != ''):?> 
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?> </div> 
        <?php endif; ?> 
        <form method = "post" action ="<?php echo $_SERVER['PHP_SELF']?>"> 
            <div class ="form-group">
                <label>Name</label> 
                <!--value below is to save whatever posted if failed--> 
                <input type ="text" name="name" class = "form-control" 
                value="<?php echo isset(/*$_POST['name']*/$name)? $name : ''; ?>"> 
            </div> 
            <div class="form-group">
                <label>Email</label> 
                <input type ="text" name ="email" class  = "form-control" 
                value="<?php echo isset($email)? $email : '' ;?>"> 
            </div> 
            <div class = "form-group">  
                <label>Message</label> 
                <textarea name ="message" class ="form-control">
                    <?php echo isset($message)? $message : '' ; ?> 
                </textarea> 
            </div> 
    
    <br> 
    <button type ="submit" name="submit" class ="btn btn-primary">Submit</button> </form> </div> 
</body> 
</html>

