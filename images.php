




<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
            integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
            crossorigin="anonymous"></script>

</head>


<body>
<div class="jumbotron">
    <h1 class="display-4">LET'S RUN</h1>
    <p class="lead">Let's go Back to a Time When We Would Run Outside</p>
    <hr class="my-4">
    <p>Join me on a visual journey throough some of my favorite parks and trails run</p>
    <p>It Might be cold out and covid got your trapped inside, so take some time to enjoy the sites</p>
    <p>Enter your favorite city below!</p>
    <form action="images.php" method="get" id="location">
        <input  type="text" name="location" placeholder="Enter a city, then hit ENTER"  style="width: 200px;"/>

    </form>
<div>

    <?php
    require 'vendor/autoload.php';

    Crew\Unsplash\HttpClient::init([
        'applicationId'	=> 'YA0GdcMHvS_kU7600JWS8hk5lLp_KFZLY_RqYeMvxMg',
        'secret'		=> 'E6lJrXldT9JDRERCR-qJl2QazevPvihXUEICCnC0t8I',
        'callbackUrl'	=> 'http://localhost:8888/XMLFinal/',
        'utmSource' => 'API final'
    ]);
   // var_dump($_GET);
    if(!empty($_GET['location'])) {
        $search = $_GET['location'].'';
        //echo 'a';
        $page = 1;
        $per_page = 5;
        $orientation = 'landscape';

        $photos =  Crew\Unsplash\Search::photos($search, $page, $per_page, $orientation);
        $results = $photos->getResults();

        $images = [];
       // echo 'b';
        // var_dump($results);

        foreach ($results as $result){
            //    array_push($images,$result['urls']['regular'] );
           // echo $result['urls']['regular'];

           // echo '<img src="' . $result['urls']['regular'] . '"/>';
            echo '<img src="'.$result['urls']['regular'].'" />';
        }

    } else {
        echo "Type a location to see more photos";
    }


    ?>
</div>

</div>
</body>
</html>











