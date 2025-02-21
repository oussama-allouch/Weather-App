<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href ="style.css" rel ="stylesheet">
    <title>weather app</title>
</head>
<body>
    <div class="container">
        <div class="appcontainer">
            <form method = "POST">
            <div class="input">
            <label id = "city"> your city </label>
            <select name="city">
            <option value = "tangier">tanger</option>
            <option value = "casablanca">casablanca</option>
            <option value = "fes">fes</option>
            <option value = "rabat">rabat</option>
            <option value = "sale">Sale</option>
            <option value = "Oujda">Oujda</option>
            <option value = "Agadir">Agadir</option>
            <option value = "Tetouan">Tetouan</option>
            <option value = "Mohammedia">Mohammedia</option>
            <option value = "Kenitra">Kenitra</option>

            </select>
            <input type = "submit" name="getTemp" value ="get temperature" id="getTemp">
            </form> 
            </div>
            <div class="result">    
            <?php
            if(isset($_POST['getTemp'])){
                $city = $_POST['city'];
                $api_key = 'yourApiKey';
                $url = "https://api.openweathermap.org/data/2.5/weather?q=$city,MA&appid=$api_key&units=metric";

                $request = curl_init();
                curl_setopt($request, CURLOPT_URL,$url);
                curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($request);
                curl_close($request);

                if($response){
                    $data = json_decode($response , false);

                    if(isset($data->main->temp)){
                        $temp = $data->main->temp;
                        $description = $data->weather[0]->description;
                        echo "<p>the temperature in $city is $temp with $description</p>";
                        if($temp > 20){
                            echo "<div class = 'sun'>☀️</div>";
                        }else{
                            echo"<div class = 'cloud'>☁️</div>";
                        }
                    }else{
                        echo "there is something wrong getting the data";
                    }
                }
                else{
                    echo "there is somthing wrong with API";
                }
            }
            ?>
            </div>
        </div>
    </div>
</body>
</html>