<?php
include 'src\HtmlReader.php';
$Reader = new Markup\HtmlReader();
?>

<!DOCTYPE>
<html>
    <head>
        <title>Results</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css">
    </head>
    <body>
        <?php
        /*
        score_html receives the path for the HTML file.
        They are stored in the database as you enter different files which will produce different results.
        */
        $Reader->score_html('data/bob_2013_02_15.html');

        $name = "Bob"; // set it to see results from different users (key)
        $from = "2015-12-01 23:00:00"; // set it to see range from this date
        $to = "2015-12-02 23:00:00"; // set it to see range to this date

        $scores = $Reader->scores_by_person($name);
        echo ucfirst($name) . " scores are: " . implode(", ", $scores) . "<br>";

        $scores = $Reader->scores_by_date_range($from, $to);
        echo "Overall scores between $from and $to are: " . implode(", ", $scores) . "<br>";

        $scores = $Reader->highest_score_by_person($name);
        echo ucfirst($name) . " highest score is: " . implode(", ", $scores) . "<br>";

        $scores = $Reader->lowest_score_by_person($name);
        echo ucfirst($name) . " lowest score is: " . implode(", ", $scores) . "<br>";

        $result = $Reader->average_score();
        $table = "<table class='table table-bordered' style='width:200px'><thead><tr><th>Key</th><th>AvgScore</th></tr></thead><tbody>";
        foreach ($result as $r) {
            $table .= "<tr><td>$r->person_name</td><td>$r->score</td></tr>";
        }
        $table .= "</tbody></table>";
        echo $table;
        ?>
    </body>
</html>

