<!DOCTYPE html>
<html>
<?php
    $movie = $_REQUEST["film"];
    $movieInfo = file("{$movie}/info.txt");
?>

<head>
    <title>
        <?php
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
        $movieInfo[2] = trim($movieInfo[2]);
        $movieInfo[3] = trim($movieInfo[3]);
    ?>
    <h1>
        <?php
            print "$movieInfo[0]"; print " ({$movieInfo[1]})"
        ;?>
    </h1>
    <div id="mainbox">
        <div id="info">
            <div>
                <?php
                    echo "<img src='$movie/overview.png' alt='general overview'>"
                ?>
            </div>
            <div id="infotext">
                <?php
                    $infotext = file("{$movie}/overview.txt");
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
                    <span id="percent"><?php print "{$movieInfo[2]}%";?></span>
                    <span id="reviewtotal">
                        <?php
                            print "({$movieInfo[3]} reviews total)";
                        ?>
                    </span>
                </div>
                <div class="column1">
                    <?php
                        $reviewCount = glob($movie . "/review*.txt");
                        $countReviews = count($reviewCount);
                        for ($a = ceil(($countReviews / 2)); $a < $countReviews; $a++) {
                    ?>
                    <p class="review">
                        <?php
                            list($content, $position, $author, $publication) = file($reviewCount[$a]);
                            $content = trim($content);
                            $position = trim($position);
                        ?>
                        <img src=<?php
                            if ($position == "ROTTEN") {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/rotten.gif";
                            } else {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/fresh.gif";
                            }
                        ?>>
                        <q><?php
                                echo $content;
                            ?>
                        </q>
                    </p>
                    <p class="reviewer">
                        <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/critic.gif" alt="critic" />
                        <span>
                            <?php
                                print $author;
                            ?>
                        </span>
                        <lt>
                            <?php
                                echo $publication;
                            ?>
                        </lt>
                    </p>
                    <?php
                        }
                    ?>
                </div>
                <div class="column2">
                    <?php
                        $reviewCount = glob($movie . "/review*.txt");
                        $countReviews = count($reviewCount);
                        for ($a = 0; $a <= ceil(($countReviews / 2) - 1); $a++) {
                    ?>
                    <p class="review">
                        <?php
                            list($content, $position, $author, $publication) = file($reviewCount[$a]);
                            $content = trim($content);
                            $position = trim($position);
                        ?>
                        <img src=<?php
                            if ($position == "ROTTEN") {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/rotten.gif";
                            } else {
                                echo "http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/fresh.gif";
                            }
                            ?>>
                        <q>
                            <?php
                                echo $content;
                            ?>
                        </q>
                    </p>
                    <p class="reviewer">
                        <img src="http://www.u.arizona.edu/~lxu/cscv337/sp18/hw2/critic.gif" alt="critic" />
                        <span>
                            <?php
                                print $author;
                            ?>
                        </span>
                        <lt>
                            <?php
                                echo $publication;
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
                echo "(1-$countReviews) of $countReviews"
            ;?>
        </p>
    </div>
</body>

</html>