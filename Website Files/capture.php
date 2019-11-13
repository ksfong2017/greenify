<?php $title = "Capture";
include 'header.php'; ?>
<div class="container mt-4 p-4">
    <div class="screen-behind text-center">
        <video id="video" width="100%" height="480" autoplay></video>
        <canvas id="canvasImage" class="text-center" width="640" height="480" style="display:none;"></canvas>
    </div>
    <form class="form text-center mt-2" method="post" action="scan_result.php" name="storeImage">
        <input type="hidden" id="photoFile" name="photoFile" value="">
    </form>
    <div class="text-center">
        <button class="btn btn-success my-2 my-sm-0" id="snap">Snap Photo</button>
    </div>
    <div class="text-center pt-c">
        <p>Or</p>
    </div>
    <div class="text-center">
        <button class="btn btn-success my-2 my-sm-0" id="upload">Upload a File</button>
    </div>
    <div class="text-center">
        <form class="form text-center mt-2 d-none" enctype="multipart/form-data" method="post" action="scan_result.php" name="" id="fileUpload">
            <input name="MAX_FILE_SIZE" value="1048576" type="hidden" />
            <input type="file" id="uploadFile2" accept=".png, .jpg, .jpeg" name="uploadFile2" />
            <label for="file">choose a file</label>
            <input type="submit" value="Submit File" />
        </form>
    </div>
</div>
<script>
    // Grab elements, create settings, etc.
    var video = document.getElementById('video');
    var lstream;
    // Get access to the camera!
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({
            video: true
        }).then(function(stream) {
            //video.src = window.URL.createObjectURL(stream);
            lstream = stream;
            video.srcObject = stream;
            video.play();
        });
    } else if (navigator.getUserMedia) { // Standard
        navigator.getUserMedia({
            video: true
        }, function(stream) {
            lstream = stream;
            video.src = stream;
            video.play();
        }, errBack);
    } else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
        navigator.webkitGetUserMedia({
            video: true
        }, function(stream) {
            video.src = window.webkitURL.createObjectURL(stream);
            lstream = stream;
            video.play();
        }, errBack);
    } else if (navigator.mozGetUserMedia) { // Mozilla-prefixed
        navigator.mozGetUserMedia({
            video: true
        }, function(stream) {
            video.srcObject = stream;
            lstream = stream;
            video.play();
        }, errBack);
    }

    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function() {
        var file = document.getElementById('photoFile');
        var canvas = document.createElement("canvas");
        var loading = document.getElementById("loading");
        canvas.width = 640;
        canvas.height = 480;
        canvas.getContext("2d").drawImage(video, 0, 0, 640, 480);
        var img = document.createElement("img");
        var img = canvas.toDataURL();

        var canvasImage = document.getElementById('canvasImage');
        var context = canvasImage.getContext('2d');
        context.drawImage(video, 0, 0, 640, 480);
        video.style.display = "none";
        lstream.getTracks().forEach(function(track) {
            track.stop();
        });
        loading.style.display = "block";
        canvasImage.style.display = "unset";
        canvasImage.style.maxWidth = "100%";
        //canvasImage.style.width="";
        //canvasImage.style.padding-left="20px";

        var img = canvas.toDataURL();
        document.forms["storeImage"].elements["photoFile"].value = img;
        document.forms["storeImage"].submit();
    });
    document.getElementById("upload").addEventListener("click", function() {
        var file = document.getElementById('uploadFile2');
        file.click();
    });

    document.getElementById("uploadFile2").onchange = function() {
        lstream.getTracks().forEach(function(track) {
            track.stop();
        });
        var loading = document.getElementById("loading");
        loading.style.display = "block";

        document.getElementById("fileUpload").submit();
    };
</script>
<style>
    @media only screen and (max-width:768px) {

        .screen-behind,
        #video {
            height: unset;
        }

    }
</style>


<?php include 'footer.php'; ?>