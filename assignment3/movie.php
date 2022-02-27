<!DOCTYPE html>
<!--
Songha Chheo
The University of Arizona
College of Applied Science & Technology
CSCV337 - WEB Programming
Assignment 3: Movie Review Part Deux
-->
<html>
<?php
    //Query parameter that allows the browser to pass the specific movie
    //from the user and corresponding location for info.txt
    $movie = $_REQUEST["film"];
    //Reads info.txt into a string array
    $movieInfo = file("{$movie}/info.txt");
?>

<head>
    <title>
        <?php
            //Prints the page title with corresponding Movie name
            print "$movieInfo[0]"; print " ({$movieInfo[1]})"
        ;?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="movie.css" type="text/css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="http://u.arizona.edu/~lxu/cscv337/sp18/hw2/rotten.gif" />
</head>

<body>
    <div id="banner">
        <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/banner.png" alt="Rancid Tomatoes" />
    </div>
    <?php
        //Read/Re-Save movieInfo array and trims spaces from index 2
        $movieInfo[2] = trim($movieInfo[2]);
        //Read/Re-Save movieInfo array and trims spaces from index 3
        $movieInfo[3] = trim($movieInfo[3]);
    ?>
    <h1>
        <?php
            //Prints the corresponding Movie Name and Release Year
            print "$movieInfo[0]"; print " ({$movieInfo[1]})"
        ;?>
    </h1>
    <div id="mainbox">
        <div id="info">
            <div>
                <?php
                //Displays the corresonding movie picture
                    echo "<img src='$movie/overview.png' alt='general overview'>"
                ?>
            </div>
            <div id="infotext">
                <?php
                    //Reads overview.txt into a string array
                    $infotext = file("{$movie}/overview.txt");
                    //Splits each element by : for heading and descriptions
                    //Prints each element heading/description
                    foreach ($infotext as $Text) {
                        $Heading = explode(":", $Text, 2);
                ?>
                <dt>
                    <?php
                        print "$Heading[0]";
                    ?>
                </dt>
                <dd>
                    <?php
                        print "$Heading[1]";
                    ?>
                </dd>
                <?php
                    }
                ?>
            </div>
        </div>
        <div id="rating">
            <div id="rotten">
                <div>
                    <?php
                        //Displays corresponding image depending on rating
                        //If element is < 60, rottenbig.png will display
                        //If > 60 freshbig.png will display
                        if ($movieInfo[2] < 60)
                        {
                    ?>
                    <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/rottenbig.png" alt="Rotten">
                    <?php
                        }
                        else {
                    ?>
                    <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/freshbig.png" alt="Rotten">
                    <?php
                        }
                    ?>
                    <span id="percent">
                        <?php
                            //Displays the coresponding movie percent rating
                            print "{$movieInfo[2]}%"
                        ;?>
                    </span>
                    <span id="reviewtotal">
                        <?php
                            //Displays the corresponding movie and number of reviews
                            print "({$movieInfo[3]} reviews total)";
                        ?>
                    </span>
                </div>
                <div class="column1">
                    <?php
                        //Returns an array of any files with matching names
                        $reviewCount = glob($movie . "/review*.txt");
                        //Saves number of elments in the array
                        $countReviews = count($reviewCount);
                        //Loops divides countReviews as the first column
                        for ($a = ceil(($countReviews / 2)); $a < $countReviews; $a++) {
                    ?>
                    <p class="review">
                        <?php
                            //Splits each review.txt into separate elements
                            list($content, $position, $author, $publisher) = file($reviewCount[$a]);
                            $content = trim($content);
                            $position = trim($position);
                        ?>
                        <img src=<?php
                            //Displays a small rotten or fresh depending on review posiiton
                            if ($position == "ROTTEN") {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/rotten.gif";
                            }
                            else {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/fresh.gif";
                            }
                        ?>>
                        <q><?php
                                //Displays the review
                                echo $content;
                            ?>
                        </q>
                    </p>
                    <p class="reviewer">
                        <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/critic.gif" alt="critic" />
                        <span>
                            <?php
                                //Displays the Reviewer
                                print $author;
                            ?>
                        </span>
                        <lt>
                            <?php
                                //Displays the Publisher
                                echo $publisher;
                            ?>
                        </lt>
                    </p>
                    <?php
                        }
                    ?>
                </div>
                <div class="column2">
                    <?php
                        //Returns an array of any files with matching names
                        $reviewCount = glob($movie . "/review*.txt");
                        //Saves number of elments in the array
                        $countReviews = count($reviewCount);
                        //Loops through remaining reviews as second column
                        for ($a = 0; $a <= ceil(($countReviews / 2) - 1); $a++) {
                    ?>
                    <p class="review">
                        <?php
                            //Splits each remaining review.txt into separate elements
                            list($content, $position, $author, $publisher) = file($reviewCount[$a]);
                            $content = trim($content);
                            $position = trim($position);
                        ?>
                        <img src=<?php
                            //Displays a small rotten or fresh depending on review posiiton
                            if ($position == "ROTTEN") {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/rotten.gif";
                            } else {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/fresh.gif";
                            }
                            ?>>
                        <q>
                            <?php
                                //Displays the review
                                echo $content;
                            ?>
                        </q>
                    </p>
                    <p class="reviewer">
                        <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/critic.gif" alt="critic" />
                        <span>
                            <?php
                                //Displays the Reviewer
                                print $author;
                            ?>
                        </span>
                        <lt>
                            <?php
                                //Displays the Publisher
                                echo $publisher;
                            ?>
                        </lt>
                    </p>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <p id="reviewNumBot">
            <?php
                //Displays entire count of reviews at the bottom of the page
                echo "(1-$countReviews) of $countReviews"
            ;?>
        </p>
    </div>
</body>

</html>