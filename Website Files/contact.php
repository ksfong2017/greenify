<?php
$title = "Contact Us";
include 'header.php'; ?>

<div class="container">
    <div class="innerwrap">



        <section class="section2 clearfix">
            <div class="col2 column1 first">
                <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC4GcwHeauD4f0J776YWj8k66slwITNb7o'></script>
                <div class="sec2map">
                    <div id='gmap_canvas' class="w-100 h-100"></div>

                </div>
                <script type='text/javascript'>
                    function init_map() {
                        var myOptions = {
                            zoom: 14,
                            center: new google.maps.LatLng(1.2973784, 103.8495219),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(1.2973784, 103.8495219)
                        });
                        infowindow = new google.maps.InfoWindow({
                            content: '<strong>SMU School of Information Systems</strong><br>80 Stamford Rd, Singapore 178902<br>'
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                </script>
            </div>
            <div class="col2 column2 last">
                <div class="sec2innercont">
                    <div class="sec2addr">
                        <p>SMU School of Information Systems, 80 Stamford Rd, Singapore 178902</p>
                        <p><span class="collig">Phone :</span> +65 1234 5678</p>
                        <p><span class="collig">Email :</span> greenify@devepi.com</p>
                        <p><span class="collig">Fax :</span> +65 1234 5679</p>
                    </div>
                </div>
                <div class="sec2contactform">
                    <h3 class="sec2frmtitle">Contact Us</h3>
                    <form id="contact-form">
                        <div class="clearfix">
                            <input class="col2 first" type="text" name="firstname" placeholder="FirstName">
                            <input class="col2 last" type="text" name="lastname" placeholder="LastName">
                        </div>
                        <div class="clearfix">
                            <input class="col2 first" type="Email" name="email" placeholder="Email">
                            <input class="col2 last" type="text" name="contact" placeholder="Contact Number">
                        </div>
                        <div class="clearfix">
                            <textarea name="textarea" id="" cols="30" rows="7" placeholder="Your message here..."></textarea>
                        </div>
                        <div class="clearfix"><input type="submit" value="Send" id="contact-btn"></div>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
<script>
    $('form').submit(function(e) {
        $.post("services/sendemail.php", $("#contact-form").serialize(), function(data) {
            alert(data);
        });
        e.preventDefault();
    });
</script>
<?php include 'footer.php'; ?>