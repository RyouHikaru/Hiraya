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
            /*  Drag and drop box for Gallery */
            .dropzone {
              width: 300px;
              height: 300px;
              border: 2px dashed #ccc;
              color: #ccc;
              line-height: 300px;
              text-align: center;
            }
            .dropzone.dragover {
              border-color: black;
              color: black;
            }
  </style>
  <?php
    session_start();

    if(isset($_SESSION['login'])) {
        $user = $_SESSION['user'];
        $filename = 'default_header.jpg';
        $file_upload_msg = '';
        $insert_to_db_msg = '';
        $gallery_file_upload_msg = "";
        // echo '<pre>';
        // print_r($_FILES);
        // print_r($user);
        // print_r($_SESSION);
        // echo '</pre>';

        if(isset($_POST['create'])) {
          // Get values from text areas
          $blog_title = $_POST['blog_title'];
          $blog_titlehead = $_POST['blog_titlehead'];
          $blog_desc = $_POST['blog_desc'];
          $blog_content = $_POST['blog_body'];
          $about_me = $_POST['about_me'];

          // echo "<pre>";
          // print_r($_FILES);
          // echo "</pre>";
          
          // IF BLOG PICTURE IS CHOSEN
          if(!empty($_FILES['blogheaderpic']['name'])) {
            $filename = $user['username'].rand().$_FILES['blogheaderpic']['name'];
            // echo $filename;
            $path = "blog_images/".$filename;
            
            if((move_uploaded_file($_FILES['blogheaderpic']['tmp_name'], $path))) {
                // IF GALLERY HAS ATLEAST 1 FILE
                if(isset($_COOKIE['uploads'])) {
                  $file_upload_msg = "<h3 style = 'color:green;'>Images uploaded!</h3>";
  
                  $gallery_files = unserialize($_COOKIE['uploads'], ["allowed_classes" => false]);
                  $len = count($gallery_files);
  
                  unset($_COOKIE['uploads']);

                  // INSERT TO DATABASE (BLOG TABLE)
                  include 'config.php';
                  $uid =  $user['user_id'];

                  $sql = "INSERT INTO blogs(user_id, blog_title, blog_description, blog_content, blog_header, about_me)
                  VALUES($uid, '$blog_title', '$blog_desc', '$blog_content', '$filename', '$about_me')";
                  // echo $sql;      
                  $result = mysqli_query($conn, $sql);

                  if($result) {
                      // INSERT TO DATABASE (GALLERY TABLE)
                      $blog_id = queryBlogID($conn);
                      
                      // echo "<pre>";
                      // print_r($gallery_files);
                      // echo "</pre>";
                      for($i = 0; $i < $len; $i++) {
                        $file = $gallery_files[$i]['file'];
                        $sql = "INSERT INTO gallery(blog_id, user_id, picture_name)
                        VALUES($blog_id, $uid, '$file')";
                        $result = mysqli_query($conn, $sql);
                        if($result) {
                          $insert_to_db_msg = "<h3 style = 'color:green;'>Blog created!</h3>";
                        }
                        else {
                          $insert_to_db_msg = "<h2 style = 'color:red;'>Error in inserting to gallery.</h2>";
                        }
                      }
                  }
                  else
                      $insert_to_db_msg = "<h2 style = 'color:red;'>Error in inserting.</h2>"; 
                }
                else {
                  $file_upload_msg = "<h3 style = 'color:red;'>Please upload atleast 1 image for your gallery.</h3>";
                }
            }
            else {
                $file_upload_msg = "<h3 style = 'color:red;'>Error in uploading file.</h3>";
            }
          }
          else {
            $file_upload_msg = "<h3 style = 'color:red;'>Please upload image for your blog.</h3>";
          }
        }
    }
    function queryBlogID($conn) {
      $sql = "SELECT MAX(blog_id) as bmax FROM blogs";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        return $row['bmax'];
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
      <textarea style="resize: none; font-size: 50px; text-align: center; border: none;" 
      name="blog_title" id="" cols="30" rows="1" placeholder="Your blog title here" required></textarea>
      <br>
  </div>

  <div class="row">
    <div class="leftcolumn">
        <div class="card">
            <!-- BLOG TITLE HEADING TEXTAREA-->
            <textarea style="resize: none; font-size: 28px; border: none;" 
            name="blog_titlehead" id="" cols="65" rows="1" placeholder="Your blog heading here" required></textarea>
            <br><br>
            <!-- BLOG DESCRIPTION TEXTAREA-->
            <textarea style="resize: none; border: none;" name="blog_desc" id="" cols="100" rows="1" 
            placeholder="Your blog description here" required></textarea>
            <br><br>

            <img src="blog_images/<?php echo $filename; ?>" alt="Blog-Header-Picture-Here" style="height: 500px;">
            
              <br>
              <label for="">Select photo:</label>
              <br>
              <input type="file" name="blogheaderpic">
              <br><br>
              <!-- BLOG BODY TEXTAREA -->
              <textarea style="resize: none;" name="blog_body" id="" cols="139" rows="5" 
              placeholder="Your blog content here" required></textarea>
              <br>
              <?php 
                echo $file_upload_msg;
                echo $insert_to_db_msg;
                echo $gallery_file_upload_msg;
              ?>
            <input type="submit" name="create" value="Create post">   
      </div>
    </div>

    <!-- ABOUT ME -->
    <div class="rightcolumn">
      <div class="card">
        <h2>About Me</h2>
        <textarea style="resize: none;" name="about_me" id="" cols="38" rows="10" 
              placeholder="Tell us about yourself" required></textarea>
      </div>

      <!-- GALLERY -->
      <div class="card">
        <h3>Gallery</h3>
          <div class="dropzone" id="dropzone">Drop files to upload here</div>
          <div id="uploads">
          </div>
          <script src='gallery_upload.js'></script> 
      </div>
    </div>
  </div>
</form>

<div class="footer">
  <h2>Footer</h2>
</div>
</body>
</html>