<!DOCTYPE html>
<html>
<head>
  <title>Blogs</title>
  <style>
          * {
              box-sizing: border-box;
            }

            /* Add a gray background color with some padding */
            body {
              font-family: Arial;
              padding: 20px;
             background-image: url(https://i.imgur.com/atdbjCR.jpg);
            }

            /* Header/Blog Title */
            .header {
              padding: 30px;
              font-size: 40px;
              text-align: center;
              background: white;
            }

            /* Create two unequal columns that floats next to each other */
            /* Left column */
            .leftcolumn {   
              float: left;
              width: 75%;
            }

            /* Right column */
            .rightcolumn {
              float: left;
              width: 25%;
              padding-left: 20px;
            }

            /* Fake image */
            img {
              background-color: #aaa;
              width: 100%;
              padding: 20px;
            }

            /* Add a card effect for articles */
            .card {
               background-color: white;
               padding: 20px;
               margin-top: 20px;
            }

            /* Clear floats after the columns */
            .row:after {
              content: "";
              display: table;
              clear: both;
            }

            /* Footer */
            .footer {
              padding: 20px;
              text-align: center;
              background: #ddd;
              margin-top: 20px;
            }

            @media screen and (max-width: 800px) {
              .leftcolumn, .rightcolumn {   
                width: 100%;
                padding: 0;
              }
            }
  </style>
  <?php
    session_start();

    if(isset($_SESSION['login'])) {
        $user = $_SESSION['user'];
        $blog_id = $_GET['blog_id'];

        // FETCH DATA FROM DB (BLOG TABLE)
        include 'config.php';

        $sql = "SELECT * FROM blogs WHERE blog_id = $blog_id";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result);
          $blog_title = $row['blog_title'];
          $blog_desc = $row['blog_description'];
          $blog_content = $row['blog_content'];
          $blog_header = $row['blog_header'];
          $about_me = $row['about_me'];
        }
        else {
          header("location: home_page.php");
        }

        // FETCH DATA FROM gallery TABLE
        $sql = "SELECT * FROM gallery WHERE blog_id = $blog_id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)) {
          $row = mysqli_fetch_all($result);
        }
        else {
          echo "ERROR GALLERY";
        }
    }
  ?>
</head>

<body>
  <?php include 'navbar.php'; ?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="header">
      <br>
      <!-- BLOG TITLE TEXTAREA-->
      <textarea readonly style="resize: none; font-size: 50px; text-align: center; border: none;" 
      name="blog_title" id="" cols="30" rows="1"><?php echo $blog_title?></textarea>
      <br>
  </div>

  <div class="row">
    <div class="leftcolumn">
        <div class="card">
            <!-- BLOG DESCRIPTION TEXTAREA-->
            <textarea readonly style="resize: none; border: none;" name="blog_desc" id="" cols="100" rows="1"><?php echo $blog_desc?></textarea>
            <br><br>

            <img src="blog_images/<?php echo $blog_header; ?>" alt="Blog-Header-Picture-Here" style="height: 500px;">
              <br><br>
              <!-- BLOG BODY TEXTAREA -->
              <textarea readonly style="resize: none;" name="blog_body" id="" cols="139" rows="5"><?php echo $blog_content?></textarea>
              <br>  
      </div>
    </div>
    <div class="rightcolumn">
      <div class="card">
        <h2>About Me</h2>
        <textarea readonlystyle="resize: none;" name="about_me" id="" cols="38" rows="10" 
              placeholder="Tell us about yourself"><?php echo $about_me?></textarea>
      </div>
      <div class="card">
        <h3>Gallery</h3>
        <?php
          $len = count($row);
          for($i = 0; $i < $len; $i++) {
            // echo $row[$i][3]."<br>";
            echo  "<a href='".$row[$i][3]."'><img style='height: 100px;' src='".$row[$i][3]."'  /></a>";
          }
        ?>
      </div>
    </div>
  </div>
</form>

<div class="footer">
  <h2>Footer</h2>
</div>
</body>
</html>