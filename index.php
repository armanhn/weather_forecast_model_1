<?php

$url = "https://api.openweathermap.org/data/2.5/forecast?q=Dhaka&appid=4a68645c7ae1136b967350d71a88207f&units=metric";
$url2 = "https://api.openweathermap.org/data/2.5/weather?q=Dhaka&appid=4a68645c7ae1136b967350d71a88207f&units=metric";
$contents = file_get_contents($url);
$contents2 = file_get_contents($url2);
$data2 = json_decode($contents2);
$data = json_decode($contents);

$current_time = $data2->dt;
$current_time += 5 * 3600;
$current_city = $data2->name;

$city = $data->city->name;
$daily = $data->list;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Weather Forecast</title>
</head>

<body>
    <section>
        <div id="main" class="container-fluid">
            <div id="data" class="container">
                <h1>Current Temperature</h1>
                <div id="weather-content" style=" text-align: center; font-size: 20px;" class="container">
                    <div>
                        <?php
                        $date = date('F j, Y, g:i a', $current_time);
                        $current_temp = $data2->main->temp;

                        echo "Current Time: " . $date . "<br>" . " Current Temperature: " . $current_temp . "&degC" . "<br>" . " City: " . $current_city;
                        ?>
                    </div>
                </div>
                <h1>Five day weather forecast</h1>
                <div id=data2>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
                            for ($i = 1; $i < 40; $i++) {
                                echo "<li data-target='#myCarousel' data-slide-to='" . $i . "'></li>";
                            }
                            ?>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner ">
                            <div class="item active" style=" text-align: center; font-size: 25px; max-height:fit-content;">
                                <div class="p4nic">
                                    <p><?php
                                        $date = date('F j, Y, g:i a', $daily[0]->dt);
                                        $min_temp = $daily[0]->main->temp_min;
                                        $max_temp = $daily[0]->main->temp_max;
                                        $weather = $daily[0]->weather[0]->main;
                                        $description = $daily[0]->weather[0]->description;
                                        $logo = $daily[0]->weather[0]->icon;
                                        echo $date . "<br>" . "Max Temperature: " . $max_temp . "&degC" . "<br>" . "Min Temperature: " . $min_temp . "&degC" . "<br>" . "Weather: " . $weather . "<br>" . "Description: " . $description;
                                        echo "<img src='https://openweathermap.org/img/w/$logo.png' alt=''>";
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                            for ($i = 1; $i < 40; $i++) {
                                echo "<div class='item' style='text-align: center; font-size: 25px; max-height:fit-content;'>";
                                echo "<div class='p4nic'>";
                                echo "<p>";
                                $date = date('F j, Y, g:i a', $daily[$i]->dt);
                                $min_temp = $daily[$i]->main->temp_min;
                                $max_temp = $daily[$i]->main->temp_max;
                                $weather = $daily[$i]->weather[0]->main;
                                $description = $daily[$i]->weather[0]->description;
                                $logo = $daily[$i]->weather[0]->icon;
                                echo $date . "<br>" . "Max Temperature: " . $max_temp . "&degC" . "<br>" . "Min Temperature: " . $min_temp . "&degC" . "<br>" . "Weather: " . $weather . "<br>" . "Description: " . $description;
                                echo "<img src='https://openweathermap.org/img/w/$logo.png' alt=''>";
                                echo "</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>