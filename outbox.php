<?php 
    /**** outbox page ****/
    // Requires edit to get the user username

    session_start();
    // DB connection
    include_once 'db.config.php'; 
    
    /********** To Be Edited ************/
    
    /* NOTICE: Edit variable $user to be equal to the user username using your session or other variable */
    /* DO NOT DELETE VARIABLE $user */
    $user = $_SESSION["username"]; 
        
    /************************************/
    

    // if not logged in
    if(empty($user)){
      echo "<h1>You must login first</h1>";
      die();
    }
    echo $user;


    if(isset($_GET['deleted'])){?>
      <div class="col-sm-4 alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Message deleted successfuly
      </div>
<?php }

?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    

  <style>
      .container{
          margin-top:3%;
          font-family:arial;
          /*text-align:center;*/
      }
      table {
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
          border: 1px solid #ddd;
          padding:20px
      }
      th, td {
          padding: 16px;
      }
      tr:nth-child(even) {
          /*background-color: #f2f2f2;*/
      }
      tr:hover{
        background-color:#eee;
      }
      tr{
        border:1px solid #ddd;
      }
      .title{
        font-size:20px;color:#17075e;font-family:Lucida Sans Unicode;
      }
      .msg{
        line-height:1.8;
        font-size:17px;
        white-space: pre-wrap;

      }
      .sender{
        color:#666;
        font-size:16px;
        /*float:right*/
      }
      .date{
        font-size:14px;float:right
      }
      .click{
        color:black;
        display:block;
      }
      .click:hover{
        color:black;
        text-decoration:none;
      }
      .del{
        float:right
      }

  </style>
</head>

<body>
    <div class="container">
          <div class="col-sm-12" style="overflow-wrap: break-word;float:right">
            <div><h1>Sent Messages</h1></div><br>

              <div style="float:left;font-size:22px""><a href="index.php">Send message</a> |&nbsp;</div>
              <div style="float:left;font-size:22px"><a href="inbox.php">Inbox</a> |&nbsp;</div>
                
                <?php if(basename($_SERVER['PHP_SELF']) == 'outbox.php'){?>
                    <div style="float:left;font-size:22px"><b><a href="outbox.php">Outbox</a></b></div>
                <?php } ?>
                
                <table>
                <thead>
                <tr style="text-align:center;color:red">
                    <th>Outbox</th>
                </tr>

                <?php
                
                // if you want to display all messages remove =>  LIMIT 15  after DESC in the next line
                $sql = "SELECT * FROM messages WHERE send_from = '$user' ORDER BY id DESC LIMIT 15";
                $result = mysqli_query($conn, $sql);
                
                // if no messages sent
                if(mysqli_num_rows($result) == 0){
                    echo '<tr style="font-size:20px"><td>No messages sent yet</tr></td>';
                    die();
                }
                echo '<div style="float:right">Total results: '.mysqli_num_rows($result).'</div>';

                while($row = mysqli_fetch_assoc($result)){
                    if($row['send_from'] == $user){
                        $msg = $row['message'];
                        
                        // if URL exists
                        if(!empty($row['URL'])){
                        echo "
                            <tr>
                            <td style='max-width:400px'>
                                <a class='click' href=".$row['URL'].">
                                    <span class='date'>".$row['send_on']."</span>
                                    <span class='title'>".$row['title']."</span>
                                    <br><br>
                                    <span class='msg'>$msg</span>
                                    <span><a href=".$row['URL'].">".$row['URL']."</a></span><br><br>
                                    <span class='sender'>Sent to ".$row['send_to']."</span>
                                    <a href='delete.php?del=".$row['id']."' style='float:left;text-decoration:none' title='Delete'><i class='fa fa-trash'></i>&nbsp;</a>";
                                    if($row['seen'] == 1){
                                    echo '<span class="sender" style="float:right;font-size:14px">seen <i class="fa fa-check"></i></span>';
                                    }echo "
                                </a>
                            </td>
                            </tr>";
                        }
                        else{
                        echo "
                            <tr>
                                <td style='max-width:400px'>
                                    <span class='date'>".$row['send_on']."</span>
                                    <span class='title'>".$row['title']."</span>
                                    <br><br>
                                    <span class='msg'>$msg</span>
                                    <span class='sender'>Sent to ".$row['send_to']."</span>
                                    <a href='delete.php?del=".$row['id']."' style='float:left;text-decoration:none' title='Delete'><i class='fa fa-trash'></i>&nbsp;</a>";
                                    if($row['seen'] == 1){
                                    echo '<span class="sender" style="float:right;font-size:14px">seen <i class="fa fa-check"></i></span>';
                                    }echo "
                                </td>
                            </tr>";
                        }
                    }
                }
            ?>
            </table>
          <br><br>
        </div>
      </div> 
    <br>
  </body>
</html> 

