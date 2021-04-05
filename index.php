<?php

    /**** index.php file is the message form ****/
    // Requires to edit only the session name to get the user username //
    
    session_start();
    // DB connection
    include_once 'db.config.php';
    
    /*************** To Be Edited ************/
    
    // login as,,, after editing sessions you can remove the following line
    $_SESSION['username'] = 'admin';
    
    // NOTICE: Edit variable $user to be equal to the user username using your session or other variable
    // DO NOT DELETE VARIABLE $user
    $user = $_SESSION["username"]; 

    // Admin username = admin,,,,, if your admin username is different change it
    $admin = 'admin';
    
    /******************************************/

    // if not logged in die "empty session"
    if(empty($user)){
        echo "<h1>You must login first</h1>";
        die();
    }
    
    echo $user;
?>

<!DOCTYPE html>
<html>

    <title>Messaging System</title>

<head>

    <!-- Rich textarea -->
    <link type="text/css" href="ckeditor5-build-classic-20.0.0/sample/css/sample.css" rel="stylesheet" media="screen" />
    <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
    
    <!-- If you have these links no need to write them again -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .container{
            margin-top:3%;
        }
        form input[type='text'], input[type='url']{
            width:100%;
            text-indent:6px;
            padding:5px;
        }
        textarea{
            text-indent:6px;
            width:100%;
            max-width:100%;
        }
        span{
            font-size:18px;
            line-height:2.0;
        }
        .text button{
            font-size:20px;
        }
        a, a:hover{
            text-decoration:none;
        }
        .badge:after{
            content:"";
            position: absolute;
            background: red;
            width:0.6rem;
            height:0.6rem;
            top:1rem;
            right:1.5rem;
            text-align: center;
            line-height: 2rem;;
            font-size: 1rem;
            border-radius: 50%;
            color:white;
        }
        /* radio buttons */
        #l1, #l2{
            margin-right:30px
        }
        button{
            border:1px solid #333;
            border-radius:5px;
        }
        
        input[type=text], textarea {
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        -ms-transition: all 0.30s ease-in-out;
        -o-transition: all 0.30s ease-in-out;
        outline: none;
        border: 1px solid #666;
        }
        
        input[type=text]:focus, textarea:focus {
        box-shadow: 0 0 5px rgba(81, 203, 238, 1);
        border: 1px solid rgba(81, 203, 238, 1);
        }

        @media only screen and (max-width: 600px)  {
            .container h1{
                margin-top:10%;
            }
            form input[type='text'], input[type='url']{
                width:100%;
            }
        }
        
    </style>
</head>
    
<body>

    <?php
        // check for public messages read or not read
        $sql_public = "SELECT * FROM public_seen WHERE user = '$user'";
        $result_public = mysqli_query($conn, $sql_public);
        $read_public = 0;

        while($row_public = mysqli_fetch_assoc($result_public)){
            // if the message already seen
            $read_public++;
        }
        
        $sql = "SELECT * FROM messages ORDER BY id ASC";
        $result = mysqli_query($conn, $sql);
        $messages = 0;
        $time=0;

        // calculating number of messages the user should see
        while($row = mysqli_fetch_assoc($result)){
            if($row['public'] == 1){
                $messages++;
                $time = $row['send_on'];
            }
            if($row['send_to'] == $user AND $row['seen'] == 0){
                $messages++;
                $time = $row['send_on'];
            }
        }

        // if there is unread Message
        if($read_public != $messages){ ?>
            <!-- Popup new message notification -->
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" style="bottom:0;position:fixed;left:15px;z-index:999">
                <div class="toast-header">
                    <i class="fa fa-envelope" style="margin-right:5px"></i>
                    <strong class="mr-auto">New Message</strong>
                    <small><?php echo $time ?></small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <a href="inbox.php" style="text-decoration:none;">
                    <div class="toast-body" style="background-color:#ddd;">
                    <?php if(($messages - $read_public) > 1){ ?>
                    You have received <?php echo $messages - $read_public ?> new messages at your inbox<?php }else{?>
                    You have received 1 new message at your inbox <?php } ?>
                    </div>
                </a>
            </div>
        <script>
            $('.toast').toast('show')   
        </script>
            
            
        <!-- Bell with red badge on receiving new message -->
        <a href='inbox.php'
            <i class='fa fa-bell badge' style='font-size:28px;float:right;margin:10px;color:#333;'></i>
        </a><br>
            
        <?php
        }
        // if all messages read
        else{
            // bell without the red badge
            echo "
            <a href='inbox.php' style='text-decoration:none'>
                <i class='fa fa-bell' style='font-size:28px;float:right;margin:10px;color:#333;'></i>
            </a><br>";
        }    
        
        // Bootstrap alert if message sent successfully
        if(isset($_GET['sent'])){?>
        <!--
            <div class="col-sm-4 alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Message sent to <?php echo $_GET['sent']; ?>
            </div>
        -->
        <?php }
?>

<!-- Message Form -->
<div class="container">
    <div class="text col-lg-6">
        <h1>Messaging System</h1><br>
        
        <!-- Check for current page url -->
        <?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){?>
            <div style="float:left;font-size:22px""><b><a href="index.php">Send message</a></b> |&nbsp;</div>
        <?php } ?>
        <div style="float:left;font-size:22px"><a href="inbox.php">Inbox</a> |&nbsp;</div>
        <div style="float:left;font-size:22px"><a href="outbox.php">Outbox</a></div><br><br>
        
        <form method="POST" action="send.php">    

            <!-- Send Message to -->
            <span>Send to</span><br>
            <!-- Only admin can send to all users-->
            <?php if($user == $admin){?>
                <input type="radio" id="send_all" name="all" value="send_all">
                <label id="l1">All Users</label>
            <?php } ?>
            
            <!-- Send to admin -->
            <input type="radio" id="admin" name="all" value="send_admin">
            <label id="l2">Send To Admin</label>
            <!-- Send to specific user -->
            <input type="radio" id="user" name="all" value="send_user" checked>
            <label>Specific User</label><br>
            
            <input type='text' id="sendto" name="sendto" value="<?php if(isset($_GET['reply'])) echo $_GET['reply']; ?>" placeholder="Username" required><br><br>
        
            <!-- Subject -->
            <span>Subject</span><br>
            <input type='text' name="title" maxlength="350" value="<?php if(isset($_GET['subject'])) echo 'RE: '.$_GET['subject']; ?>" placeholder="Enter subject" required><br><br>
            
            <!-- Message -->
            <span>Message</span><br>
            
            <!-- Rich textarea -->
            <textarea id="msg" name="msg" placeholder="Enter your message"></textarea><br>
            <!-- Rich textarea script -->
            <script>
                ClassicEditor
                    .create( document.querySelector( '#msg' ) )
                    .catch( error => {
                        console.error( error );
                    } );
                    CKEDITOR.replace('descCKEditor',{ width: "500px",height: "500px"}); 
            </script>

            
            <!-- Normal Textarea -->
            <!-- If you don't want this comment this and uncomment the normal text area 
            <span>Message</span><br>
            <textarea id="" rows="5" cols="68" name="msg" maxlength="1500" placeholder="Enter your message" style='max-width:100%' required></textarea><br><br>
            -->
            
            <!-- Attach Message Clickable URL --->
            <!--<span>Attach URL</span><br>
            <input type='url' style="color:blue" name="url"  placeholder="Full URL (example: http://bitbytecodes.com)" ><br><br>-->
            
            <button name="send" class="btn btn-primary">Send message</button>
        </form>
    </div>
</div>
<br>


<!--  Disabling (#sendto) Input on selecting radio button  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
    <!-- Disable on selecting send_all radio button -->
    <script>
        $(document).ready(function(){
            $("#send_all").change(function(){
                if($(this).prop("checked")){
                    $("#sendto").prop("disabled",true);
                }
                else{
                    $("#sendto").prop("disabled",false);
                }
            });
        });

         /* Disable on selecting send to admin radio button */
        $(document).ready(function(){
            $("#admin").change(function(){
                if($(this).prop("checked")){
                    $("#sendto").prop("disabled",true);
                }
                else{
                    $("#sendto").prop("disabled",false);
                }
            });
        });

        /* Enabling on selecting send to specific user radio button */
        $(document).ready(function(){
            $("#user").change(function(){
                if($(this).prop("checked")){
                    $("#sendto").prop("disabled",false);
                }
                else{
                    $("#sendto").prop("disabled",true);
                }
            });
        });

        /* on selecting send to admin radio button set text to admin */
        $(document).ready(function(){
          $("#admin").click(function(){
            $("#sendto:text").val("admin");
          });
        });
        
        /* on selecting send to all users radio button set text to null */
        $(document).ready(function(){
          $("#send_all").click(function(){
            $("#sendto:text").val(" ");
          });
        });
        
        /* on selecting send to specific user radio button set text to empty */
        $(document).ready(function(){
          $("#user").click(function(){
            $("#sendto:text").val("");
          });
        });
    </script>



</body>
</html>