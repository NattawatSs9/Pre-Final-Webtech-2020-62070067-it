<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>

    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;500&amp;display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

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

    .card{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        width: 40%;
        margin: 5px;
    }
    form{
        padding: 0;
        width: 100%;
    }

}

    </style>
</head>
<body>
    <div class="content container row">
        <form method="post">
            <?php
                $click = 0;
                $check_all = true;
                $word = "";

                if(isset($_POST['test'])) {
                    $click = 1;

                    if($click == 1){
                        $word = $_POST['text'];
                    }
                }

                echo '<h4>ระบุคำค้นหา :</h4>';
                echo '<div style="width: 100% ;"><input id="text" placeholder="หา" name="text" value="' . $word . '" class="form-control align-center" style="width: 80%; display: inline-block;">
                <button type="submit" name="test" class="btn btn-success">ค้นหา</button></div>';
                echo '<br>'
            ?>

            </form>
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $counter = 0;
                $find = 0;

                if ($word == ""){
                    $check_all = false;
                    foreach ($result->tracks->items as $items){
                        echo '<div class="card" style="width: 32%;">';
                        foreach ($items->album->images as $img){
                            if ($img->height == 640){
                                echo '<img class="card-img-top" src="';
                                echo $img->url;
                                echo '">';
                            }
                        }
                        echo '<div class="card-body" style="font-size: 18px;">';
                        echo '<p style="font-size: 25px">';
                        echo $items->album->name;
                        echo "</p>";
                        foreach ($items->album->artists as $artists){
                            echo "Artist: ";
                            echo $artists->name;
                            echo "<br>";
                        }
                        echo "Release date: ";
                        echo $items->album->release_date;
                        echo "<br>";
                        foreach ($items->album->available_markets as $available_markets){
                            $check_country++;
                        }
                        echo "Avaliable : ";
                        echo $check_country;
                        echo " countries <br>";
                        echo '</div>';
                        echo '</div>';
                    }
                }
                else{
                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos(($artists->name), ($word)) !== false){
                                $check = true;
                            }
                        }
                        if (strpos(($items->album->name), ($word)) !== false || $check){
                            $find++;
                        }
                    }
                    if ($find > 1){
                        echo "<div style='width:100%; margin-bottom: 10px;'>ค้นหาเจอทั้งหมด ";
                        echo $find;
                        echo " รายการ<br></div>";
                    }
                    foreach ($result->tracks->items as $items){
                        $check = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos(($artists->name), ($word)) !== false){
                                $check = true;
                            }
                        }
                        if (strpos(($items->album->name), ($word)) !== false || $check){
                            $check_all = false;
                            echo '<div class="card" style="width: 30%;">';
                            foreach ($items->album->images as $image){
                                if ($image->height == 640){
                                    echo '<img class="card-img-top" src="';
                                    echo $image->url;
                                    echo '">';
                                }
                            }
                            echo '<div class="card-body" style="font-size: 18px;">';
                            echo "<p class='card-head' >";
                            echo $items->album->name;
                            echo "</p>";
                            foreach ($items->album->artists as $artists){
                                echo "Artist: ";
                                echo $artists->name;
                                echo "<br>";
                            }
                            echo "Release date: " . $items->album->release_date . "<br>";
                            foreach ($items->album->available_markets as $available_markets){
                                $counter++;
                            }
                            echo "Avaliable : ";
                            echo $counter;
                            echo " countries<br>";
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }

                if ($check_all){
                    echo 'Not Found';
                }
            ?>
    </div>
</body>
</html>
