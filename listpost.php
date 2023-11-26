<?php
  include_once('app/helper/Helper.php');
  $help = new Helper();
?> 
<section>
        <div class="bg_in">
            <div class="module_pro_all">
                <div class="box-title">
                    <div class="title-bar">
                        <h1>Tin tức</h1>
                   
                    </div>
                </div>
                <div class="pro_all_gird">
                    <div class="girds_all list_all_other_page ">
                        <?php
                        foreach ($listposthome as $key => $p){ 
                      
                        ?>
                     <div class="row">
                        
                             <div class="col-md-2">
                                 <img src="<?php echo BASE_URL ?>/teamplate/image/post/<?php echo $p['image'] ?>" class="img img-responsive">
                             </div>
                            <div class="col-md-10">
                                <h4><a href="<?php echo BASE_URL ?>/p/details/<?php echo $p['postId'] ?>/<?php echo $help->makeUrl($p['title']) ?>"><?php echo $p['title'] ?></a></h4>
                                <p><?php echo $p['sum'] ?></p>

                            </div>

                     </div>

                     <br>
                     <?php
                     } 
                     ?>
                  
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            
    </section>
    <!--end:body-->
    <div class="clear"></div>