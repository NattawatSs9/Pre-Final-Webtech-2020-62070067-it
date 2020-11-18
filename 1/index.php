<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    * {
        font-family: 'Kanit', sans-serif;
    }

    body {
        padding-top: 50px;
        height: 100%;
        background-color: #F0FFFF;
    }
    .content{
        margin: auto;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        margin: 5px;
        transition: 0.3s;
    }
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
    }

}

    </style>
</head>
<body>
    <div class="container content row" style="margin-auto">
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $check_country = 0;

                foreach ($result->tracks->items as $all){
                    echo '<div class="card" style="width: 32%;">';
                    foreach ($all->album->images as $img){
                        if ($img->height == 640){
                            echo '<img class="card-img-top" src="';
                            echo $img->url;
                            echo '">';
                        }
                    }
                    echo '<div class="card-body" style="font-size: 18px;">';
                    echo '<p style="font-size: 25px">';
                    echo $all->album->name;
                    echo "</p>";
                    foreach ($all->album->artists as $artists){
                        echo "Artist: ";
                        echo $artists->name;
                        echo "<br>";
                    }
                    echo "Release date: ";
                    echo $all->album->release_date;
                    echo "<br>";
                    foreach ($all->album->available_markets as $available_markets){
                        $check_country++;
                    }
                    echo "Avaliable : ";
                    echo $check_country;
                    echo " countries <br>";
                    echo '</div>';
                    echo '</div>';
                }
            ?>
    </div>
</body>
</html>
