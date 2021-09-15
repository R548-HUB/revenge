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
        <?php include 'dbconnect.php'; ?>
        <?php
        include'header.php';
        ?>
       
        <?php
        $id = $_GET['catid'];
        $sql = " SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
        ?>
        <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            //insert thread into db
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            $th_title = str_replace("<" , "&lt;" , $th_title);
            $th_title = str_replace(">" , "&gt;" , $th_title);
            $th_desc = str_replace("<" , "&lt;" , $th_desc);
            $th_desc= str_replace(">" , "&gt;" , $th_desc);
            
             $sno = $_POST['sno'];
            $sql = " SELECT * FROM `categories` WHERE category_id=$id";
            
            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', CURRENT_TIMESTAMP)";
            $result = mysqli_query($con, $sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success! </strong>  Your thread has been added!Please wait for community to respond.
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
                <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
                <p class="lead"> <?php echo $catdesc; ?></p>
                <hr class="my-4">
                <p>this is a peer to peer forum for sharing knowledge with each other .</p>
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </div>

        </div>
        <?php
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true) {
         echo'<div class="container">
           <h1>Start Discussion</h1>
           <form action ="'. $_SERVER["REQUEST_URI"].'" method="post">
           <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Staement</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Keep your problem statement  short and crisp as possible.</small>
                </div>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Elaborate your concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        }
        else{
            echo '<div class="container">
                <h1>Start Discussion</h1>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong > YOU ARE NOT LOGGEDIN ! TO START DISCUSSION YOU MUST LOGIN YOURSELF .THANKYOU</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 </div>';
        }
        ?>       
        <div class="container my-3">
            <h1>Browse Questions</h1>

            <?php
            $id = $_GET['catid'];
            $sql = " SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($con, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_time=$row['timestamp'];
                $thread_user_id=$row['thread_user_id'];
                $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                 $result2 = mysqli_query($con, $sql2);
                 $row2 = mysqli_fetch_assoc($result2);
               
                 
                 
                echo' <div class="media my-3">
                      <img src="img/default_user.png" width="34px" class="mr-3" alt="user">
                  <div class="media-body">'.
                  
                  '<h5 class="mt-0"> <a class="text-dark" href= "thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                   ' . $desc . '</div>'.'<p class="font-weight-bold my-0">ASKED BY: '.$row2['user_email'].' at '.  $thread_time .'</p>'.
                  
                ' </div>';
            }

            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                         <div class="container">
                              <p class="display-4">No Threads Found</p>
                              <p class="lead">be the first to ask questions.</p>
                         </div>
                      </div>';
            }
            ?>
            
            <!--   REMOVE LATER JUST TO CHECK HTML ALLIGNMENT-->
            <!--  <div class="media my-3">
               <img src="img/default_user.png" width="34px" class="mr-3" alt="user">
              <div class="media-body">
               <h5 class="mt-0">unable to start pip in window.</h5>
               <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
              </div>
              </div>
            -->

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



