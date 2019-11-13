<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/script.js"></script>
    <script src="scripts/moment.js"></script>
    <script src="scripts/popper.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
    <script src="scripts/jquery.counterup.min.js"></script>
    <title>Greenify | Go Green!</title>

    <script>
        function call1() {
            // alert("call");
            var button = document.getElementById('file');
            button.click();
            // var canvas = document.createElement("canvas");
            //   canvas.width = 640;
            //   canvas.height = 480;
            //   canvas.getContext("2d").drawImage(video, 0, 0, 640, 480);

            // var img = canvas.toDataURL();
            // document.forms["storeImage"].elements["photoFile"].value = img;
        }

        function call2() {
            // alert("call2");
            var sub = document.getElementById('submit');
            sub.click();
        }

        if (window.location.pathname == '/' || window.location.pathname == '/index.php') {

            window.onscroll = function() {
                scrollFunction()
            };
        } else {

        }

        function scrollFunction() {

            if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
                jQuery(".mb").addClass("down");
            } else {
                jQuery(".mb").removeClass("down");
            }
        };
        jQuery.fn.visible = function(partial) {

            var $t = jQuery(this),
                $w = jQuery(window),
                viewTop = $w.scrollTop(),
                viewBottom = viewTop + $w.height(),
                _top = $t.offset().top,
                _bottom = _top + $t.height(),
                compareTop = partial === true ? _bottom : _top,
                compareBottom = partial === true ? _top : _bottom;

            return ((compareTop <= viewBottom));
        }
        var down = false;
        var myFunction = function() {

            if (down) {

                jQuery(".mb").removeClass("dropdown-down");
                down = false;

            } else {
                if (!jQuery(".mb").hasClass("down")) {
                    jQuery(".mb").addClass("dropdown-down");
                }

                down = true;

            }
        };

        function checkFooter() {
            var div = 0;
            $("body > *").each(function() {
                div += $(this).height();
            })



            var win = $(window).height();

            if (div < win) {
                jQuery(".my-footer").addClass("footer-down");
            } else {
                jQuery(".my-footer").removeClass("footer-down");
            }
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                // some code..

            } else {
                if (window.location.pathname == '/map.php') {
                    jQuery(".my-footer").addClass("footer-down");
                }


            }
        }

        jQuery(document).ready(function(e) {
           
            checkVisible();


        });
        
        $(window).on('resize', function() {


        });
        jQuery(window).scroll(function(e) {
            checkVisible();

        });


        function checkVisible() {
            jQuery('.hidden').each(function(i, k) {
                if (jQuery(this).visible()) {
                    jQuery(k).addClass('visible');
                    jQuery(k).removeClass('hidden');
                }

            });
        }

        function addRecord(typeOfRecord) {
            $.ajax({
                url: "services/add.php?type=" + typeOfRecord,
                context: document.body
            }).done(function() {
                alert("Thanks for saving the earth!");
            });
        }
    </script>

</head>

<body>
    <div class="mb <?php if ($_SERVER['REQUEST_URI'] != "/index.php" && $_SERVER['REQUEST_URI'] != "/") {
                        echo "down";
                    } ?>">
        <div class="container menubar">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="https://greenify.devepi.com">
                    <img src="images/logo.png" width="40" height="40" alt="">
                    <h5 class="logo-title">Greenify</h5>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" onclick="myFunction()" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == "/index.php" || $_SERVER['REQUEST_URI'] == "") {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == "/about.php") {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <!-- <li class="nav-item">
            <a class="nav-link" href="capture.php">Capture</a>
        </li> --><?php require_once "Mobile_Detect.php";
                    $detect = new Mobile_Detect;
                    if ($detect->isMobile()) { ?>

                            <li class="nav-item  <?php if ($_SERVER['REQUEST_URI'] == "/capture.php") {
                                                            echo "active";
                                                        } ?>">
                                <a class="nav-link" href="#" onclick="call1()">Capture</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item  <?php if ($_SERVER['REQUEST_URI'] == "/capture.php" || $_SERVER['REQUEST_URI'] == "/scan_result.php") {
                                                            echo "active";
                                                        } ?>">
                                <a class="nav-link" href="capture.php">Capture</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item  <?php if (strpos($_SERVER['REQUEST_URI'], "/map.php") !== false) { 
                                                    echo "active";
                                                } ?>">
                            <a class="nav-link" href="map.php">Locations</a>
                        </li>
                        <li class="nav-item  <?php if ($_SERVER['REQUEST_URI'] == "/article.php") {
                                                    echo "active";
                                                } ?>">
                            <a class="nav-link" href="article.php">Articles</a>
                        </li>
                        <li class="nav-item  <?php if ($_SERVER['REQUEST_URI'] == "/info.php") {
                                                    echo "active";
                                                } ?>">
                            <a class="nav-link" href="info.php">Info</a>
                        </li>
                        <li class="nav-item  <?php if ($_SERVER['REQUEST_URI'] == "/contact.php") {
                                                    echo "active";
                                                } ?>">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>

                    </ul>

                    <form class="d-none" action="scan_result.php" method="post" enctype="multipart/form-data">
                        <input id="file" type="file" accept="image/*;capture=camera" onchange="call2()" name="uploadFile2" id="photoFile">

                        <input type="submit" value="" id="submit">
                    </form>


                </div>

            </nav>
        </div>
    </div>

    <?php if ($_SERVER['REQUEST_URI'] != "/index.php" && $_SERVER['REQUEST_URI'] != "/") { ?>
        <div class="menu-div w-100"></div>
        <div class="breadcrumbs-bar">
            <div class="container d-flex">
                <div class="col-md-6 bc-col">
                    <h5 class="breadcrumbs"><?php echo $title; ?></h5>
                </div>
                <div class="col-md-6 text-right bc-col">
                    <p class="breadcrumbs"><?php echo "<a href='index.php'>Home</a>  /  " . $title; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>