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
        
        <?php include'header.php';?>
        
        
       
        
        <!-- sliders starts from here -->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/slider-2"  class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>IT'S A 1st PHASE OF YOUR FORUM</h5>
        <p>Firstly you have to ask some questions about your doubt   .</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/slider4" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>HERE COMES SECOND PHASE </h5>
        <p>May be someone gives you satisfactory answers someone not! Don't react in impulsion.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/slider6" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>IT'S FINALE AND LAST</h5>
        <p>Always ready to give meaningful work to others.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        <!--category starts here-->
        <div class="container my-4">
            <h3 class="text-center my-4" text="center">
               iVISION -BROWSE CATEGORIES
            </h3>
            <div class="row my-4">
              <!-- fetch all the categories here and use a for loop to iterate through categories... --> 
                <?php 
                $sql= "SELECT * FROM `categories`";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    //echo $row['category_id'];
                      $id=  $row['category_id'];
                    $cat = $row['category_name'];
                     $desc = $row['category_description'];
                    echo'<div class="col-md-4 my-3">
                           <div class="card " style="width:  18rem ;">
                              <img src="img/card-' .$id. '.jpg"  class="card-img-top" alt="...">
                              <div class="card-body ">
                               <h5 class="card-title"><a href="threads.php?catid=' . $id . '">' . $cat .'</a></h5>
                               <p class="card-text">' . substr($desc,0,100 ). '</p>
                               <a href="threads.php?catid=' . $id . '" class="btn btn-primary">View threads</a>
                        </div>
                    </div>
                </div>';
                    
                }
                
                ?>                
                
              
                
                

                
            </div>
            
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

