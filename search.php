<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <title>visions</title>
        <style>
            .cnt{
                min-height:82vh;
            }
        </style>
    </head>
    <body>
        <?php  include 'dbconnect.php';?>
        
        <?php include'header.php';?>
       
        
        <!-- search result start here-->
        <div class="container my-3 cnt">
            <h1> Search result for <em>" <?php echo $_GET['search']?>"</em></h1>
            <?php 
            $noresult=true;
              $query=$_GET['search'];
              $sql= " select * from `threads` where match (thread_title,thread_desc) against ('$query')";
              $result = mysqli_query($con,$sql);
        
              while($row = mysqli_fetch_assoc($result)){
            
               $title= $row['thread_title'];
               $desc= $row['thread_desc'];
               $thread_id=$row['thread_id'];
               $url = "thread.php?threadid=".$thread_id;
               $noresult=false;
               // display the search result
               echo '<div class="result my-3">
                <h3><a href="'.$url.'" class="text-dark"> '.$title.'</a> </h3>
                <p class="py-3">'.$desc.'</p>
            
        
         </div>';     
               
              }
         if($noresult){
            echo' <div class="container my-4">
                <div class="jumbotron jumbotron-fluid">
                         <div class="container">
                              <p class="display-4">No Results Found</p>
                              <p class="lead">Suggestions:<ul>

                             <li> Make sure that all words are spelled correctly.</li>
                              <li>Try different keywords.</li>
                              <li>Try more general keywords.</li></p>
                         </div>
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