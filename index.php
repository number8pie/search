<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sykes Cottages Coding Exercise || Home</title>
    <meta name="author" content="Lee Thomas">
    <meta name="description" content="Sykes Cottages Coding Exercise Homepage">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
</head>

<body>
    <main role="main">
        <section class="search-form">
            <?php
                // Connnect to DB to populate some options
                include_once("php/db_connect.php");
            ?>
            <form action="search-results.php" method="POST" id="search_form">
                <div class="search-form__row">
                    <label for="search_location" class="search-form__label">Location</label>
                    <select name="search_location" id="search_location" class="select2 search-form__input" required>
                        <option value selected disabled>please select a location</option>
                        <?php
                            // Query DB for locations and sort
                            $query_locations = $connection->prepare("SELECT location_name FROM locations");
                            $query_locations->execute();
                            $data_locations = $query_locations->fetchAll(PDO::FETCH_COLUMN);
                            sort($data_locations);

                            // Display each location as an option
                            foreach ($data_locations as $value) {
                                echo '<option value="'.$value.'">"'.$value.'"</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="search-form__row">
                    <label for="search_date" class="search-form__label">Date Arriving</label>
                    <input type="text" name="search_date" autocomplete="off" id="search_date" class="jqueryui-datepicker search-form__input search-form__input--general" required>
                </div>

                <div class="search-form__row">
                    <?php
                        // Query DB for sleeps and sort
                        $query_sleeps = $connection->prepare("SELECT sleeps FROM properties");
                        $query_sleeps->execute();
                        $data_sleeps = $query_sleeps->fetchAll(PDO::FETCH_COLUMN);
                        rsort($data_sleeps);
                    ?>
                    <label for="search_sleeps" class="search-form__label">Sleeps: <span class="range-value">1</span></label>
                    <input type="range" min="1" max="<?php echo $data_sleeps[0]; ?>" value="1" name="search_sleeps" id="search_sleeps" class="range-slider search-form__input">
                </div>

                <div class="search-form__row">
                    <?php
                        // Query DB for beds and sort
                        $query_beds = $connection->prepare("SELECT beds FROM properties");
                        $query_beds->execute();
                        $data_beds = $query_beds->fetchAll(PDO::FETCH_COLUMN);
                        rsort($data_beds);
                    ?>
                    <label for="search_beds" class="search-form__label">Beds: <span class="range-value">1</span></label>
                    <input type="range" min="1" max="<?php echo $data_beds[0]; ?>" value="1" name="search_beds" id="search_beds" class="range-slider search-form__input">
                </div>

                <div class="search-form__row">
                    <div class="search-form__col-50">
                        <label for="search_beach" class="search-form__label search-form__label--checkbox">  
                            <input type="checkbox" name="search_beach" id="search_beach" class="search-form__input search-form__input--checkbox">
                            <span class="box"></span>
                            Near a Beach
                        </label>
                    </div>

                    <div class="search-form__col-50">
                        <label for="search_pets" class="search-form__label search-form__label--checkbox">  
                            <input type="checkbox" name="search_pets" id="search_pets" class="search-form__input search-form__input--checkbox">
                            <span class="box"></span>
                            Accepts Pets
                        </label>
                    </div>
                </div>

                <div class="search-form__row">
                    <input type="submit" value="Search" class="cta cta--blue search-form__submit">    
                </div>
            </form>
        </section>
    </main>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script
        src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
        crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>