<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <title>visions</title>
        
    </head>
    <body>
        <?php  include 'dbconnect.php';?>
        <?php
        include'header.php';
        ?>
       
        <?php
        $id= $_GET['threadid'];
        $sql= " SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($con,$sql);
        
        while($row = mysqli_fetch_assoc($result)){
            
            $title= $row['thread_title'];
            $desc= $row['thread_desc'];
            $thread_user_id= $row['thread_user_id'];
            // Query  the users table to find outthe name of OP
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
            
            
        }
        
        ?>
         <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            //insert into  comment db
            $comment = $_POST['comments'];
            $comment = str_replace("<" , "&lt;" , $comment);
            $comment = str_replace(">" , "&gt;" , $comment);
            $sno = $_POST['sno'];
     
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ( ' $comment', '$id', CURRENT_TIMESTAMP, '$sno')";
            $result = mysqli_query($con, $sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success! </strong>  Your comment has been added.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                      </div>';
            }
        }
        ?>
        
      
        <!--category starts here-->
        <div class="container my-4">
            <div  class="jumbotron bg-dark text-white ">
               <h1 class="display-4"> <?php echo $title;?> </h1>
               <p class="lead"> <?php echo $desc;?></p>
               <hr class="my-4">
               <p>this is a peer to peer forum for sharing knowledge with each other .</p>
               <p>posted by:<b> <?php echo $posted_by ;?></b></p>
            </div>
            
        </div>
        
          <?php
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true) {
         echo'<div class="container my-3">
                 <h1>Post Your Comment</h1>
           <form action ="'. $_SERVER['REQUEST_URI'].'" method="post">
           
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comments" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                </div>

                <button type="submit" class="btn btn-success">Post </button>
            </form>
        </div>';
        }
        else{
            echo '<div class="container">
                <h1>Post Your Comment</h1>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong > YOU ARE NOT LOGGEDIN ! FOR POST YOUR COMMENTS  MUST BE LOGIN YOURSELF .THANKYOU</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 </div>';
        }
        ?>
        
        
               
               
        
        <div class="container my-3">
            <h1>Discussion</h1>
              <?php
            $id = $_GET['threadid'];
            $sql = " SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($con, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
               $comment_time = $row['comment_time'];
               $thread_user_id=$row['comment_by'];
               $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                 $result2 = mysqli_query($con, $sql2);
                 $row2 = mysqli_fetch_assoc($result2);
                

                echo' <div class="media my-3">
                      <img src="img/default_user.png" width="34px" class="mr-3" alt="user">
                  <div class="media-body">
                    <p class="font-weight-bold my-0">'.$row2['user_email'].' at ' . $comment_time .'</p>
                  
                   ' . $content . '
                  </div>
                 </div>';
            }

            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                         <div class="container">
                              <p class="display-4">No Comments Found</p>
                              <p class="lead">be the first to Comment.</p>
                         </div>
                      </div>';
            }
            ?>
            
        </div>

        <?php
        include'footer.php';
        ?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        -->
    </body>
</html>


