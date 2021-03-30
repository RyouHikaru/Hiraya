<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
	<link rel="icon" href="images/hiraya_icon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/69e995a5a1.js" crossorigin="anonymous"></script>
  <title>El Nido, Palawan</title>
</head>

<style>
  .main-body{
    font-family: 'Poppins', sans-serif;
  }
  div.text{
    font-family: 'Poppins', sans-serif;
    font-size: 30px;
    color: white;
  }
  h2{
    color: #c9e265;
    text-decoration: underline;
  }
</style>

<body>
<?php include 'navbar.php'; ?>
  <div class="div-body">
    
    <div class="div-body-margin"></div>
    <br>
    <div class="div-content">
      <div class="div-content-location">
        <img class="location-img" src="https://i.imgur.com/pbnkVLY.jpg">
        <div class="text">E l  N i d o, P a l a w a n</div>
      </div>
      
      <div class="tab">
        <center>
          <button class="tablinks" onclick="openTab(event, 'Travel')">Travel Spots</button>
          <button class="tablinks" onclick="openTab(event, 'Transportation')">Transportation Guide</button>
          <button class="tablinks" onclick="openTab(event, 'Hotel')">Hotels</button>
          <button class="tablinks" onclick="openTab(event, 'Dialect')">Profile</button>
          <button class="tablinks" onclick="openTab(event, 'Restaurant')">Restaurants</button>
        </center>
      </div>
      <script>
        function openTab(evt, tabName) {
          // Declare all variables
          var i, tabcontent, tablinks;

          // Get all elements with class="tabcontent" and hide them
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }

          // Get all elements with class="tablinks" and remove the class "active"
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }

          // Show the current tab, and add an "active" class to the button that opened the tab
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
        } 
      </script>

      <div id="Travel" class="tabcontent">
        <div class="location-travel-slideshow">
          <div class="slideshow-container slider" id="div1">
            <div class="mySlides fade">
              <img src="https://i.imgur.com/jHVACjt.jpg" id="img_slide">
              <h1><div class="text">Seven Commandos Beach </div></h1>
            </div>
            <div class="mySlides fade">
              <img src="https://i.imgur.com/zHc9SjO.jpg" id="img_slide">
              <div class="text">Las Cabanas Beach</div>
            </div>
            <div class="mySlides fade">
              <img src="https://i.imgur.com/FRWLy4H.jpg" id="img_slide">
              <div class="text">Scuba Diving</div>
            </div>

            <a class="prev" onclick="plusDivs(this,-1)">&#10094;</a>
            <a class="next" onclick="plusDivs(this,1)">&#10095;</a>
          </div>
        </div>
        <br>
        
        <div class="location-travel-slideshow">
          <div class="slideshow-container slider" id="div2">
            <div class="mySlides fade">
              <img src="https://i.imgur.com/pbnkVLY.jpg" id="img_slide">
              <div class="text">Windsurfing</div>
            </div>
            <div class="mySlides fade">
              <img src="https://i.imgur.com/FgdctQq.jpg" id="img_slide">
              <div class="text">Snorkeling</div>
            </div>
            <div class="mySlides fade">
              <img src="https://i.imgur.com/uIVZuNR.jpg" id="img_slide">
              <div class="text">Secret Beach</div>
            </div>

            <a class="prev" onclick="plusDivs(this,-1)">&#10094;</a>
            <a class="next" onclick="plusDivs(this,1)">&#10095;</a>
          </div>
        </div>
        <div class="location-travel-slideshow">
          <div class="slideshow-container slider" id="div3">
            <div class="mySlides fade">
              <img src="https://i.imgur.com/e9JV14M.jpg" id="img_slide">
              <div class="text">Snake Island</div>
            </div>
            <div class="mySlides fade">
              <img src="https://i.imgur.com/xqOtWK1.jpg" id="img_slide">
              <div class="text">Nagkalit-Kalit Waterfalls</div>
            </div>
            <div class="mySlides fade">
              <img src="https://i.imgur.com/9EB1cKx.jpg" id="img_slide">
              <div class="text">Small Lagoon</div>
            </div>

            <a class="prev" onclick="plusDivs(this,-1)">&#10094;</a>
            <a class="next" onclick="plusDivs(this,1)">&#10095;</a>
          </div>
        </div>
        <script>
          var sliderObjects = [];
          createSliderObjects();

          function plusDivs(obj, n) {
            var parentDiv = $(obj).parent();
            var matchedDiv;
            $.each(sliderObjects, function(i, item) {
              if ($(parentDiv[0]).attr('id') == $(item).attr('id')) {
                matchedDiv = item;
                return false;
              }
            });
            matchedDiv.slideIndex=matchedDiv.slideIndex+n;
            showDivs(matchedDiv, matchedDiv.slideIndex);
          }

          function createSliderObjects() {
            var sliderDivs = $('.slider');
            $.each(sliderDivs, function(i, item) {
              var obj = {};
              obj.id = $(item).attr('id');
              obj.divContent = item;
              obj.slideIndex = 1;
              obj.slideContents = $(item).find('.mySlides');
              showDivs(obj, 1);
              sliderObjects.push(obj);
            });
          }

          function showDivs(divObject, n) {
            debugger;
            var i;
            if (n > divObject.slideContents.length) {
              divObject.slideIndex = 1
            }
            if (n < 1) {
              divObject.slideIndex = divObject.slideContents.length
            }
            for (i = 0; i < divObject.slideContents.length; i++) {
              divObject.slideContents[i].style.display = "none";
            }
            divObject.slideContents[divObject.slideIndex - 1].style.display = "block";
          }
        </script>
      </div>

      <div id="Transportation" class="tabcontent">
        <center><h2>HOW TO GET TO EL NIDO?</h2>
        <p><h3>Via Private Plane</h3>
        <h4>•AirSwift is the only airline that flies from Manila directly to Lio Airport in El Nido. They operate up to four flights per day.</h4>
        <h3>Via Puerto Prinsesa</h3>
        <h4>•Vans are the most popular option among travelers for land travel to El Nido because it’s slightly faster than the bus with a travel time of 5-6 hours. </h4>
		    </p></center>
      </div>

      <div id="Hotel" class="tabcontent">
        <center><h2>WHERE TO STAY IN EL NIDO</h2></center>
       
        <div class="location-station">
          <center>
            <div class="location-station-content">
              <a href="https://mbcelnido.com/">
                <img class="location-station-img" src="https://i.imgur.com/eoBC1ID.png">
                 <div class="location-station-text"><center><h1>MAREMEGMEG BEACH CLUB</h1></center></div>
              </a>
            </div>
            <div class="location-station-content">
              <a href="https://vellago.com/">
                <img class="location-station-img" src="https://i.imgur.com/mB7bcRh.png">
                 <div class="location-station-text"><center><h1>VELLAGO RESORT</h1></center></div>
              </a>
            </div>
            <div class="location-station-content">
              <a href="https://lio.sedahotels.com/">
                <img class="location-station-img" src="https://i.imgur.com/UYOGnVx.png">
                 <div class="location-station-text"><center><h1>SEDA LIO</h1></center></div>
              </a>
            </div>
        </div>
      </div>
      
      <div id="Dialect" class="tabcontent">
      <center> <h2>PROFILE</h2>
        <p><h3>Languages: English and Tagalog</h3>
        <h3>Dialect: Cuyonon, Hiligaynon, Visayan dialect, Bicolano</h3>
			<br><h3>About El Nido:</h3>
 			<h3>El Nido Resorts has received numerous international awards as testament to its green practices and commitment to sustainable tourism, <br>
      including the prestigious ASEAN Green Hotel Standard in 2010 and the Wild Asia Responsible Tourism Award in 2009.</h3>
      </p></center>
      </div>

      <div id="Restaurant" class="tabcontent">
        <center><h2>WHERE TO EAT IN EL NIDO</h2></center>
        <div class="location-station">
          <center>
            <div class="location-station-content">
              <a href="#">
                <img class="location-station-img" src="https://i.imgur.com/e10zYyJ.png">
                 <div class="location-station-text"><center><h1>The Nesting Table</h1></center></div>
              </a>
            </div>
            <div class="location-station-content">
              <a href="#">
                <img class="location-station-img" src="https://i.imgur.com/DQFCrVR.png">
                 <div class="location-station-text"><center><h1>Bella Vita El Nido</h1></center></div>
              </a>
            </div>
            <div class="location-station-content">
              <a href="#">
                <img class="location-station-img" src="https://i.imgur.com/FuBNr7m.png">
                 <div class="location-station-text"><center><h1>Tambok’s</h1></center></div>
              </a>
            </div>
            <div class="location-station-content">
              <a href="#">
                <img class="location-station-img" src="https://i.imgur.com/B6mu4bU.png">
                 <div class="location-station-text"><center><h1>Taste El Nido – The Vegan Café PH</h1></center></div>
              </a>
            </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="div-blog-footer">
    <h3>All rights reserve. Hiraya 2021</h3>
  </div>
</body>
</html>

