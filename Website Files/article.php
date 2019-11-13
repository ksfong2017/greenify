<?php
$title = "Articles";
include 'header.php'; ?>

<div class="container  pt-custom2" id="articles">


</div>
<script>
    var page = 1;

    function loadNews() {
        if (page < 5) {
            var newsApiKey = ''; // Add your api key
            var url = 'https://newsapi.org/v2/everything?' + 'q=Recycling&' + 'apiKey=' + newsApiKey + '&page=' + page;

            var req = new Request(url);
            fetch(req).then(response =>
                response.json().then(data => ({
                    data: data,
                    status: response.status
                })).then(res => {

                    var articles = res.data.articles;

                    for (var k in articles) {

                        var article = articles[k];
                        var art = document.getElementById("articles");
                        art.innerHTML += "<div class='card mb-2 hidden'><div class='card-body'><h5 class='card-title'>" + article.title + "</h5><p class='card-text'>" + article.description + "<a href='" + article.url + "' target=_blank>Read More</a></p></div> </div>";

                    }
                    checkVisible();
                }));
            page++;
            $(window).bind('scroll');
        }
    }
    loadNews();
    
</script>
<?php include 'footer.php'; ?>