<?php

$title = "Scan Result";
include 'header.php'; ?>
<?php

require "vendor/autoload.php";

use Clarifai\API\ClarifaiClient;
use Clarifai\DTOs\Inputs\ClarifaiURLImage;
use Clarifai\DTOs\Outputs\ClarifaiOutput;
use Clarifai\DTOs\Predictions\Concept;
use Clarifai\DTOs\Searches\SearchBy;
use Clarifai\DTOs\Searches\SearchInputsResult;
use Clarifai\DTOs\Models\ModelType;

// Skip the argument to fetch the key from the CLARIFAI_API_KEY env. variable
$client = new ClarifaiClient('');

// Get Unique File name
$filename = "";
$fname = "";
while (true) {
    $id = str_replace('.', '', uniqid('button', true));
    $fname = $id;
    $filename = $fname . '.jpg';
    if (!file_exists('uploads/' . $filename) && !file_exists('uploads/' . $fname . '.jpeg') && !file_exists('uploads/' . $fname . '.png')) {
        break;
    }
}


// Desktop Webcam
if (isset($_POST["photoFile"])) {
    $data = $_POST["photoFile"];
    $url =  substr($data, strpos($data, ",") + 1);

    file_put_contents('uploads/' . $filename, base64_decode($url));
}

// Desktop Upload File
if (isset($_FILES['uploadFile2'])) {

    if ($_FILES["uploadFile2"]["error"] > 0) {
        echo "Error: " . $_FILES["uploadFile2"]["error"] . "<br>";
    } else {

        $ext = pathinfo($_FILES["uploadFile2"]["name"], PATHINFO_EXTENSION);
        $filename = $fname . "." . $ext;
        move_uploaded_file($_FILES["uploadFile2"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . '/' . 'uploads/' . $filename);
    }
}


$u = 'https://greenify.devepi.com/uploads/' . $filename;


$uploadOk = 1;
$model = $client->publicModels()->generalModel();
$response = $model->batchPredict([
    new ClarifaiURLImage($u),
])->executeSync();

if (!$response->isSuccessful()) {
    echo "Response is not successful. Reason: \n";
    echo $response->status()->description() . "\n";
    echo $response->status()->errorDetails() . "\n";
    echo "Status code: " . $response->status()->statusCode();
    exit(1);
}
$outputs = $response->get();

$image = $outputs[0]->input();
$mat_id = -1;
$category = "";
$method = "";
$found = false;
$switch = true;

$objectArr = $outputs[0]->data();

$mat_results;
$family_results;
$data;

try {
    $mat_url = "http://api.earth911.com/earth911.getMaterials?api_key=";
    $mat_content = file_get_contents($mat_url);
    $mat_dataObj = json_decode($mat_content);
    $mat_results = $mat_dataObj->result;

    $family_url = "http://api.earth911.com/earth911.getFamilies?api_key=";
    $family_content = file_get_contents($family_url);
    $family_dataObj = json_decode($family_content);
    $family_results = $family_dataObj->result;
} catch (Exception $e) {
    $data = "Invalid Input or No data found!";
}



$counter = -1;
while (!$found) {
    $counter++;
    $object = $objectArr[$counter]->name();
    if (strtolower($object) == "people") {
        $category = "People";
        break;
    }

    if (strtolower($object) != "one") {



        foreach ($mat_results as $result) {
            $desc = $result->description;

            $pos = strpos(strtolower($desc), strtolower($object));
            $pos2 = strpos(strtolower($object), strtolower($desc));
            $same = strtolower($object) == strtolower($desc);

            if ($same || $pos != false || $pos2 != false) {

                if (!$found) {
                    $mat_id = $result->material_id;
                    if (isLight($result->description)) {
                        $category = "Lighting";
                    }
                }
                $found = true;
            }
        }


        if ($category == "") {


            foreach ($family_results as $result) {

                if (array_key_exists('material_ids', $result)) {

                    $material_ids = $result->material_ids;
                    foreach ($material_ids as $id) {
                        if ($id == $mat_id) {
                            if ($switch) {
                                $category = $result->description;
                            }
                            $switch = false;
                        }
                    }
                }
            }
        }
    }
}
$methodArr = array(
    "Automotive" => "inorganic", "Batteries" => "ewaste", "Construction" => "inorganic", "Electronics" => "ewaste", "Garden" => "garden",
    "Glass" => "recyclingbins", "Hazardous" => "ewaste", "Holiday" => "secondhandcollecn", "Household" => "secondhandcollecn", "Metal" => "recyclingbins",
    "Paint" => "recyclingbins", "Paper" => "recyclingbins", "Plastic" => "recyclingbins", "All Materials" => "recyclingbins", "Construction and Demolition" => "inorganic",
    "Hazardous Products" => "ewaste", "Metals" => "recyclingbins", "Organics" => "organic", "Other" => "uncatogorise", "Reuse" => "secondhandcollecn",
    "Unsponsored Materials" => "uncatogorise", "Close The Loop" => "uncatogorise", "E-World" => "uncatogorise", "Rubbermaid" => "uncatogorise", "Staples" => "uncatogorise",
    "Greener Garage" => "uncatogorise", "State DEQ" => "uncatogorise", "Lighting" => "lighting"
);
// Youtube API

// Call set_include_path() as needed to point to your client library.
require_once($_SERVER["DOCUMENT_ROOT"] . '/google-api-php-client/src/Google_Client.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/google-api-php-client/src/contrib/Google_YouTubeService.php');

/* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
  Google APIs Console <http://code.google.com/apis/console#access>
  Please ensure that you have enabled the YouTube Data API for your project. */
$DEVELOPER_KEY = '';

$client = new Google_Client();
$client->setDeveloperKey($DEVELOPER_KEY);

$youtube = new Google_YoutubeService($client);

try {
    $o = "Reuse " . $object;

    $searchResponse = $youtube->search->listSearch('id,snippet', array(
        'q' => $o,
        'maxResults' => 3,
    ));

    $videos = '';
    $channels = '';

    foreach ($searchResponse['items'] as $searchResult) {
        switch ($searchResult['id']['kind']) {
            case 'youtube#video':
                $videos .= sprintf(
                    '<li>%s (%s)</li>',
                    $searchResult['snippet']['title'],
                    "<a href=http://www.youtube.com/watch?v=" . $searchResult['id']['videoId'] . " target=_blank>   Watch This Video</a>"
                );
                break;
            case 'youtube#channel':
                $channels .= sprintf(
                    '<li>%s (%s)</li>',
                    $searchResult['snippet']['title'],
                    $searchResult['id']['channelId']
                );
                break;
        }
    }
} catch (Google_ServiceException $e) {
    $htmlBody .= sprintf(
        '<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage())
    );
} catch (Google_Exception $e) {
    $htmlBody .= sprintf(
        '<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage())
    );
}
?>
    <div>
        <div class="container">
            <div class="row">
                <h3 class="w-100 text-center hidden"></h3>
                <p class="w-100 text-center hidden"></p>
                <div class="pt-custom2 w-100 d-flex home-col hidden">
                    <div class="col-md-7">

                        <img class="w-100" src="uploads/<?php echo $filename; ?>">

                    </div>
                    <div class="col-md-5">
                        <h4 class="text-capitalize"><?php echo $object; ?></h4>
                        <h5><?php if ($found) {
                                echo $category;
                            } else {
                                echo "Category Not Found";
                            } ?></h5>
                        <p>
                            <?php
                            if ($found) {
                                $method = $methodArr[$category];
                            }
                            echo "<b>Recycling Method:</b> ";
                            if ($method == "inorganic" || $method == "organic") {
                                echo "Kindly check the " . $method . " section in the following link:<br>
                <a href='https://www.nea.gov.sg/docs/default-source/our-services/waste-management/list-of-all-general-waste-collectors.pdf'  target=_blank>Waste Management</a>";
                            } elseif ($method == "ewaste") {
                                echo "You can recycle this at the nearest E-Waste Bin from your current location! <br>Find nearest E-Waste Bin <a href='map.php?q=ewaste' >here</a>!";
                            } elseif ($method == "lighting") {
                                echo "You can recycle this at the nearest Lighting Waste Bin from your current location! <br>Find nearest Lighting Waste Bin <a href='map.php?q=lighting' >here</a>!";
                            } elseif ($method == "garden") {
                                echo "Find out more about recycling of Garden Waste at 
                <a href='https://www.nea.gov.sg/our-services/waste-management/3r-programmes-and-resources/national-recycling-programme'  target=_blank>here</a>.";
                            } elseif ($method == "recyclingbins") {
                                echo "You can recycle this at the nearest Recycling Bin from your current location! <br>Find nearest Recycling Bin <a href='map.php?q=recyclebin' >here</a>!";
                            } elseif ($method == "secondhandcollecn") {
                                echo "You can donate this at the nearest 2nd Hand Collection Point from your current location! <br>Find nearest 2nd Hand Collection Point <a href='map.php?q=2ndhand' >here</a>!";
                            } else {
                                echo "You can check the 
                <a href='https://www.nea.gov.sg/our-services/waste-management/overview'  target=_blank>NEA Website</a>
                 to find out more about recycling methods.";
                            }
                            ?>
                        </p>
                        <?php
                        if ($videos != "") {
                            echo "<p class='mb-0'><b>Some Reuse Methods on Youtube:</b></p>";
                            echo $videos;
                        }
                        ?>
                        <?php if ($method == "ewaste" || $method == "lighting" || $method == "recyclingbins" || $method == "secondhandcollecn") {
                            ?>
                            <div class="pt-custom3">
                                <h5>I am going to </h5>
                                <div class="row">
                                    <div class="col-4 recordbtn" onclick="addRecord(1)">
                                        <img class="w-100" src="images/btnreduce.png">
                                        <p class="text-center">Reduce</p>
                                    </div>
                                    <div class="col-4 recordbtn" onclick="addRecord(2)">
                                        <img class="w-100" src="images/btnreuse.png">
                                        <p class="text-center">Reuse</p>
                                    </div>
                                    <div class="col-4 recordbtn" onclick="addRecord(3)">
                                        <img class="w-100" src="images/btnrecycle.png">
                                        <p class="text-center">Recycle</p>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    function isLight($object)
    {
        $check = strpos(strtolower($object), "light");
        $check2 = strpos(strtolower($object), "blub");
        $check3 = strpos(strtolower($object), "fluorescent tubes");
        if ($check != false) {
            return true;
        } elseif ($check2 != false) {
            return true;
        } elseif ($check3 != false) {
            return true;
        }
        return false;
    }

    ?>
    <?php include 'footer.php'; ?>