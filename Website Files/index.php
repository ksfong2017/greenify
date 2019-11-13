<?php include 'header.php';

$link = mysqli_connect("localhost", "devepico_green", "sm;@P@rb82&7", "devepico_greenify", "3306");

// Check connection
if ($link === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
} ?>
<header class="video-index">
  <div class="overlay video-index"></div>
  <video autoplay="autoplay" loop="loop" muted="muted">
    <source src="video/greenery.mp4" type="video/mp4">
  </video>
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      <div class="w-100 text-white">
        <div class="display-3">
          <form class="form-inline" autocomplete="off" method="get" action="search_result.php">
            <h1 id="search-label">I want to </h1>
            <h1 id="text-changing">Reduce</h1>
            <div class="autocomplete" id="home-search">
              <input class="form-control mr-2 text-center" type="input" placeholder="" aria-label="Search" id="myInputSearch" name="object">
            </div>
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            <input type="submit" class="d-none" id="btnsubmit" />
          </form>
        </div>
        <p class="lead mb-0"></p>
      </div>
    </div>
  </div>
</header>
<div>
  <div class="container">
    <div class="row pt-custom">
      <h3 class="w-100 text-center hidden">Our Mission</h3>
      <p class="w-100 text-center hidden"></p>
      <div class="pt-custom2 w-100 d-flex home-col hidden">
        <div class="col-md-7">

          <img class="w-100" src="images/bottle-plants.jpg">

        </div>
        <div class="col-md-5 pt-custom2">
          <h4>One Stop Web Portal</h4>
          <p class="text-justify"> To be a one stop web portal for Singapore Residence to get information on how to reduce their waste and how to dispose of their waste properly. Promoting and simplifying the process of 3Rs (Reduce, Recycle & Reuse) to encourage more people to recycle.</p>

        </div>
      </div>

    </div>
  </div>
</div>
<div>
  <div class="container">
    <div class="row pt-custom">

      <div class="pt-custom2 w-100 d-flex hidden">
        <div class="col-md-4 counter-col">
          <h1><span class="counter" id="reduce"><?php $query = mysqli_query($link, "SELECT COUNT(*) AS mycount FROM data WHERE type = '1'");
                                                $id = 0;
                                                if (!$query) {
                                                  die('Error: ' . mysqli_error($query));
                                                }

                                                $res = mysqli_fetch_object($query);

                                                echo $count = $res->mycount; ?></span></h1>
          <h3>No. of Reduce</h3>
          <i class="fa fa-users"></i>
        </div>
        <div class="col-md-4 counter-col">
          <h1><span class="counter" id="reuse"><?php $query = mysqli_query($link, "SELECT COUNT(*) AS mycount FROM data WHERE type = '2'");
                                                $id = 0;
                                                if (!$query) {
                                                  die('Error: ' . mysqli_error($query));
                                                }

                                                $res = mysqli_fetch_object($query);

                                                echo $count = $res->mycount; ?></span></h1>
          <h3>No. of Reuse</h3>
          <i class="fa fa-desktop"></i>
        </div>
        <div class="col-md-4 counter-col">
          <h1><span class="counter" id="recycle"><?php $query = mysqli_query($link, "SELECT COUNT(*) AS mycount FROM data WHERE type = '3'");
                                                  $id = 0;
                                                  if (!$query) {
                                                    die('Error: ' . mysqli_error($query));
                                                  }

                                                  $res = mysqli_fetch_object($query);

                                                  echo $count = $res->mycount; ?></span></h1>
          <h3>No. of Recycle</h3>
          <i class="fa fa-coffee"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <div class="container">
    <div class="row pt-custom">
      <h3 class="w-100 text-center hidden">Why Reduce, Reuse & Recycle?</h3>
      <p class="w-100 text-center hidden"></p>
      <div class="pt-custom2 w-100 d-flex home-col hidden">
        <div class="col-md-7">

          <img class="w-100" src="images/trash.jpg">

        </div>
        <div class="col-md-5 pt-custom2">
          <h4>Pulau Semakau</h4>
          <p class="text-justify">Pulau Semakau is an island located south of Singapore with part of the island being used as Singapore’s waste landfill. In 2017, Singapore generated <b>7.7 million tonnes of waste</b>. It is projected that at this rate, Semakau landfill will <b>only last for another 16 years</b>. It is crucial for Singapore Residence to play their part in reducing the amount of trash they throw everyday.</p>

        </div>
      </div>
      <div class="pt-custom w-100 d-flex home-col hidden desktop">
        <div class="col-md-5 pt-custom2">
          <h4>Reduce</h4>
          <p class="text-justify">By reducing the amount of waste you create can help build a more sustainable future for the young ones. We can achieve a reduction by buying only necessities, products that can be reused, all-purpose household cleaner and more. We understand that cutting down on everything is impossible but by cutting down one item at a time, it makes a huge difference.</p>

        </div>
        <div class="col-md-7">

          <img class="w-100" src="images/reduce.jpg">

        </div>
      </div>
      <div class="pt-custom w-100 d-flex home-col hidden mobile">
        <div class="col-md-7">
          <img class="w-100" src="images/reduce.jpg">
        </div>
        <div class="col-md-5 pt-custom2">
          <h4>Reduce</h4>
          <p class="text-justify">By reducing the amount of waste you create can help build a more sustainable future for the young ones. We can achieve a reduction by buying only necessities, products that can be reused, all-purpose household cleaner and more. We understand that cutting down on everything is impossible but by cutting down one item at a time, it makes a huge difference.</p>



        </div>
      </div>
      <div class="pt-custom w-100 d-flex home-col hidden">
        <div class="col-md-7">
          <img class="w-100" src="images/reuse.jpg">
        </div>
        <div class="col-md-5 pt-custom2">
          <h4>Reuse</h4>
          <p class="text-justify">Reusing everyday items can help reduce waste pollution. Many everyday items around the home can be used for different purposes. Such as turning paper bags to wrapping paper, old clothes into cushion covers, newspaper as packing materials and many more. Start reusing items that are reusable today!
          </p>



        </div>
      </div>
      <div class="pt-custom w-100 d-flex home-col hidden desktop">
        <div class="col-md-5 pt-custom2">
          <h4>Recycle</h4>
          <p class="text-justify">Recycling is an important factor in conserving natural resources and greatly contributes to improving the environment. We must act fast as the amount of waste we create is increasing all the time. </p>

        </div>
        <div class="col-md-7">

          <img class="w-100" src="images/recycle.jpg">

        </div>
      </div>
      <div class="pt-custom w-100 d-flex home-col hidden mobile">
        <div class="col-md-7">
          <img class="w-100" src="images/recycle.jpg">
        </div>
        <div class="col-md-5 pt-custom2">
          <h4>Recycle</h4>
          <p class="text-justify">Recycling is an important factor in conserving natural resources and greatly contributes to improving the environment. We must act fast as the amount of waste we create is increasing all the time. </p>



        </div>
      </div>
    </div>
  </div>
</div>
<div class="d-none">
  <div class="container">
    <div class="row pt-custom">
      <div class="col-md-4">
        <div class="card">
          <img src="images/1RecycleWhitePaper.jpg" class="card-img-top index-card" alt="...">
          <div class="card-body">
            <h5 class="card-title">Paper</h5>
            <p class="card-text">Paper is made from natural fibers, mostly wood. In addition to being easily recyclable, many paper products are also compostable and reusable. However, some papers are contaminated with food and other debris, making them non-recyclable. Take a peek below for…</p>
            <a href="paper.php" class="btn btn-success">Learn More</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="images/Plastic.jpg" class="card-img-top index-card" alt="...">
          <div class="card-body">
            <h5 class="card-title">Plastic</h5>
            <p class="card-text">No matter what the recycling number is (e.g. #1 through #7), most plastics start out as a petroleum product like oil or natural gas, with the exception of Compostable Plastics. Let’s get technical. The numbers identify the polymer structure of the plastic. You can think of them as being different types, and they are…</p>
            <a href="plastic.php" class="btn btn-success">Learn More</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm">
          <img src="images/Metals.jpg" class="card-img-top index-card" alt="...">
          <div class="card-body">
            <h5 class="card-title">Metal</h5>
            <p class="card-text">Metals are elements that start out as rocks (called ores). It takes lots of energy to mine them, grind them, and heat them up (smelting) to get just the part we want. For example, it takes eight tons of the ore bauxite to make one ton of aluminum. While this process is very energy intensive, the good news is…</p>
            <a href="metal.php" class="btn btn-success">Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="scripts/script.js"></script>
<script>
  autocomplete(document.getElementById("myInputSearch"), materials);


  function resizeVideoOverlay() {
    var videoHeight = jQuery("video").height();
    jQuery(".video-index").height(videoHeight);

  };
  $(document).ready(function() {
    resizeVideoOverlay();
    

  });
  $(window).on('resize', function() {

    resizeVideoOverlay();
  });
  var text = ["Reduce", "Reuse", "Recycle"];
  var counter = 0;
  var elem = document.getElementById("text-changing");
  var inst = setInterval(change, 1500);

  function change() {
    $(function() {

      $('#text-changing').fadeOut(500, function() {
        $(this).text(text[counter]).fadeIn(500);
      });

    });
    //elem.innerHTML = text[counter];
    counter++;
    if (counter >= text.length) {
      counter = 0;
      // clearInterval(inst); // uncomment this if you want to stop refreshing after one cycle
    }
  };

  jQuery('.counter').counterUp({
    delay: 10,
    time: 2000
  });
  jQuery('.counter').addClass('animated fadeInDownBig');
  jQuery('h3').addClass('animated fadeIn');

  $.fn.textWidth = function(text, font) {

    if (!$.fn.textWidth.fakeEl) $.fn.textWidth.fakeEl = $('<span>').hide().appendTo(document.body);

    $.fn.textWidth.fakeEl.text(text || this.val() || this.text() || this.attr('placeholder')).css('font', font || this.css('font'));

    return $.fn.textWidth.fakeEl.width();
  };

  $('#myInputSearch').on('input', function() {

    if ($(window).width() > 768) {
      var inputWidth = $(this).textWidth();
      if (inputWidth > 180) {
        $(this).css({
          width: inputWidth
        })
      } else {
        $(this).css({
          width: 180
        })
      }
    }
  }).trigger('input');


  function inputWidth(elem, minW, maxW) {
    elem = $(this);

  }

  var targetElem = $('#myInputSearch');

  inputWidth(targetElem);

  // Get the input field
  var input = document.getElementById("myInputSearch");

  // Execute a function when the user releases a key on the keyboard
  input.addEventListener("keyup", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
      // Cancel the default action, if needed
      event.preventDefault();
      // Trigger the button element with a click
      document.getElementById("btnsubmit").click();
    }
  });
</script>

<?php include 'footer.php'; ?>