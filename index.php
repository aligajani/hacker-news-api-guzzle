<?php

require_once('HackerNews.php');

//carbon library
use Carbon\Carbon;

//initialize our class
$api = new HackerNews();

//get the list of top 100 stories
$top_items_full= $api->get_top_stories_ids();

//slice that down to 10
$top_items = array_slice($top_items_full, 0, 10);


?>


<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">

<!--[if lte IE 8]> <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css"> <![endif]-->
<!--[if gt IE 8]><!--> <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css"> <!--<![endif]-->
<!--[if lte IE 8]> <link rel="stylesheet" href="http://purecss.io/combo/1.17.16?/css/layouts/blog-old-ie.css"> <![endif]-->
 <!--[if gt IE 8]><!--> <link rel="stylesheet" href="http://purecss.io/combo/1.17.16?/css/layouts/blog.css"> <!--<![endif]-->
<!--[if lt IE 9]> <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script> <![endif]-->

<style type="text/css">
.post-title { font-size:18px; }
.post-title a { color:grey; }
</style>

</head>
<body>


<div id="layout" class="pure-g">
    <div class="sidebar pure-u-1 pure-u-md-1-4">
        <div class="header">
            <h1 class="brand-title">Playing with the Hacker News API</h1>
            <h2 class="brand-tagline">Using Guzzle</h2>
            	<nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="pure-button" href="http://www.mrgeek.me/technology/tutorials/php/playing-with-the-hacker-news-api">Back to Article</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

    <div class="content pure-u-1 pure-u-md-3-4">
        <div>
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <h1 class="content-subhead">Top Stories</h1>


            <?php foreach ($top_items as $item_id) { 
            	$item 	= $api->get_item_data_by_id($item_id); 
            	$user 	= $api->get_user_data_by_id($item['by']);
            ?>

              <section class="post">
                    <header class="post-header">

                        <h2 class="post-title"><a target="_blank" href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?> </a></h2>

                        <p class="post-meta">
                            By <a title="<?php echo $user['karma']; ?>" href="#" class="post-author"><?php echo $item['by']; ?></a> with score of <a class="post-category post-category-design" href="#"> <?php echo $item['score']; ?></a> <a class="post-category post-category-pure" href="#"> <?php echo Carbon::createFromTimeStamp($item['time'])->diffInHours();?> hours ago </a> 
                        </p>
                    </header>
                </section>
       
            <?php } ?>
           	</div>

            <div class="footer">
                <div class="pure-menu pure-menu-horizontal pure-menu-open">
                    <ul>
                        <li><a href="http://mrgeek.me/">About</a></li>
                        <li><a href="http://twitter.com/MrGeekOfficial/">Twitter</a></li>
                        <li><a href="http://github.com/aligajani/">GitHub</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>




