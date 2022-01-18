<?php
require_once "syspath.php";
require_once SYS_PATH.'/inc/header.php';
require_once "nav_bar.php";
?>
<main role="main" class="container starter-template">
     <?php require_once "search_form.php"; ?>
    <div class="row">

        <!--error / success message will apprear here -->
        <div id="response"></div>
        <div class="col-lg-12 col-xs-12 tab-content">
            <div class="ftco-blocks-cover-1">
                <div class="site-section-cover overlay" style="background-image: url('<?php echo(APP_URI) ?>/images/img1.jpeg')">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                
                                <h1 class="mb-3 text-primary">Properties</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div id="posts" class="row no-gutter">

                        <?php foreach($data as $val){?>
                             <div class="item web col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4" style="border: 1px solid #eee; padding: 20px">
                                <strong>County: <?php echo $val->county; ?></strong>
                                <small>Country: <?php echo $val->country; ?></small>
                                <small>Town: <?php echo $val->town; ?></small>
                                <small><p>Address:<?php echo $val->address; ?></p></small>
                                <small>Long: <?php echo $val->latitude; ?> Lat: <?php echo $val->longitude; ?></small>
                                <a href="<?php echo $val->image; ?>" class="item-wrap" data-fancybox="gal">
                                    <span class="icon-search2"></span>
                                    <img class="img-fluid" src="<?php echo $val->image; ?>">
                                     <img src="<?php echo $val->thumbnail; ?>" style="z-index: 10; position: relative; margin-top: -100px; margin-left:240px;">
                                </a>
                                 <small>No of Bedrooms: <?php echo $val->num_bedrooms; ?> -> No of Bathrooms: <?php echo $val->num_bathrooms; ?></small>
                                <p style="font-size: 12px;"><?php echo $val->description; ?></p>
                                   
                                    <p>Price: <?php echo $val->price; ?></p>
                                    <?php $pro_type = json_decode( $val->property_type, true); ?>
                                    <small><strong>Type:</strong> <?php echo ($pro_type['type']); ?><br>
                                    <strong>Description:</strong> <?php echo ($pro_type['description']); ?></small><br>
                                    <small><strong>Available for:</strong> <?php echo $val->type; ?></small>
                                    <small><strong>Date Posted:</strong> <?php echo $val->created_at; ?></small>
                                </div>

                                <?php } ?>
                                </div>

                                <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                                <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                                </div>


                                <ul class="pagination" style="width: 100%;">
                                <?php if($page_no > 1){
                                    echo "<li style'margin-left: 50px;'><a href='?page_no=1'>First Page</a></li>";
                                } ?>
                                    
                                <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?> style="margin-left: 400px;">
                                <a <?php if($page_no > 1){echo "href='?page_no=$previous_page&token=$crfToken'";} ?>>Previous</a>
                                </li>
                                    
                                <li <?php if($page_no >= $total_no_of_pages){
                                echo "class='disabled'";
                                } ?>>
                                <a <?php if($page_no < $total_no_of_pages) {echo "href='?page_no=$next_page&token=$crfToken'";} ?> style="margin-right: 400px;">Next</a>
                                </li>

                                <?php if($page_no < $total_no_of_pages){
                                echo "<li style'margin-right 400px;'><a href='?page_no=$total_no_of_pages&token=$crfToken'>Last &rsaquo;&rsaquo;</a></li>";
                                } ?>
                                </ul>

                    
                </div>
            </div>
        </div>
    </div>
</main>

<?php

require_once SYS_PATH.'/inc/footer.php';


?>
