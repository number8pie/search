<?php
    include_once("php/db_connect.php");

    $location   = (isset($_POST['search_location']) ? $_POST['search_location'] : false);
    $date       = (isset($_POST['search_date'])     ? $_POST['search_date']     : false);
    $sleeps     = (isset($_POST['search_sleeps'])   ? $_POST['search_sleeps']   : false);
    $beds       = (isset($_POST['search_beds'])     ? $_POST['search_beds']     : false);
    $beach      = (isset($_POST['search_beach'])    ? $_POST['search_beach']    : false);
    $pets       = (isset($_POST['search_pets'])     ? $_POST['search_pets']     : false);

    // Build query
    $query_string  = "SELECT location_name, property_name, sleeps, beds, near_beach, accepts_pets";
    $query_string .= " FROM properties INNER JOIN locations ON properties._fk_location = locations.__pk";
    $query_string .= " WHERE locations.location_name = '$location'";
    $query_string .= " AND properties.sleeps >= '$sleeps'";
    $query_string .= " AND properties.beds >= '$beds'";
    if($beach){
        $query_string .= " AND properties.near_beach = 1";
    }
    if($pets){
        $query_string .= " AND properties.accepts_pets = 1";
    }
    $query_string .= ";";

    // Query table
    $query = $connection->prepare($query_string);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sykes Cottages Coding Exercise || Search Results</title>
    <meta name="author" content="Lee Thomas">
    <meta name="description" content="Sykes Cottages Coding Exercise Search Results">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
</head>

<body>
    <main role="main">
        <?php if(!$location || !$date){ ?>
            <p>Sorry but you must fill out the Location and Date fields to search.<br>
               Please <a href="http://sykes-search.localhost">go back</a> and try again!</p>
        <?php } else { ?>
            <?php if(!empty($results)){ ?>
                <table class="search-form__table">
                    <thead>
                        <tr>
                            <?php
                                foreach ($results[0] as $key => $val) {
                                    echo "<th>";
                                    echo str_replace("_", " ", $key);
                                    echo "</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($results as $key => $result){
                                echo "<tr>";
                                foreach ($result as $key => $val) {
                                    echo "<td>";
                                    if($key == 'near_beach' || $key == 'accepts_pets'){
                                        if($val == "1"){
                                            echo '<span class="icon--check"></span>';
                                        } else if ($val == "0") {
                                            echo '<span class="icon--cross"></span>';
                                        }
                                    } else {
                                        echo $val;
                                    }
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>Sorry there were no resuts for that search, please <a href="http://sykes-search.localhost">go back</a> and try again!</p>
            <?php } ?>
        <?php } ?>
    </main>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="js/main.js"></script>
</body>
</html>