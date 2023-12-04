<?php

  include_once('app/helper/Helper.php');

  $help = new Helper();

?> 

<section>

        <div class="bg_in">

            <div class="col-md-7 col-xs-12 col-sm-12" style="padding: 0;margin-top:10px;">

                <div id="myCarousel" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->

                    <ol class="carousel-indicators">

                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

                        <li data-target="#myCarousel" data-slide-to="1"></li>

                        <li data-target="#myCarousel" data-slide-to="2"></li>

                    </ol>

                

                    <!-- Wrapper for slides -->

                    <div class="carousel-inner">

                        <?php

                        $i = 0;

                        foreach($list_slider as $key => $slide){ 

                            $i++;

                        ?>

                        <div class="item <?php if($i==1){ echo 'active';}else{ echo '';} ?>">

                            <img src="<?php echo BASE_URL ?>/teamplate/image/slider/<?php echo $slide['slideImg'] ?>" alt="<?php echo $slide['slide_alt'] ?>">

                        </div>

                        <?php

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

            <div class="col-md-4 col-xs-12 col-sm-12" style="padding: 0;margin-top:5px;margin-left: 20px;">

                <div class="row">

                    <div class="panel  panel-warning panel-styling">

                        <div class="panel-heading">Tin tức cập nhật</div>

                        <div class="panel-body scrollable-panel">

                        <?php 

                        foreach($listposthome as $key => $post){

                        ?>

                            <div class="row">

                                <div class="col-md-4 col-xs-4 col-sm-4">

                                    <img src="<?php echo BASE_URL ?>/teamplate/image/post/<?php echo $post['image'] ?>">

                                </div>

                                <div class="col-md-8 col-xs-8 col-sm-8">

                                    <h6><a href="<?php echo BASE_URL ?>/p/details/<?php echo $post['postId']?>/<?php echo $help->makeUrl($post['title'])?>"><?php  echo $post['title'] ?></a></h6>

                                 <!--    <p><?php  echo $post['sum'] ?></p> -->

                                </div>

                            </div>

                            <hr>

                        <?php

                        } 

                        ?>

                        </div>

                    </div>

                </div>

            </div>



        </div>

        <div class="clear"></div>

    </section>