<?php
include_once('app/helper/Helper.php');
$help = new Helper();
?> 
<div class="btn_menu_search">
                <div class="bg_in">
                    <div class="table_row_search">
                        <div class="menu_top_cate">
                            <div class="">
                                <div class="menu" id="menu_cate">
                                    <div class="menu_left">
                                        <i class="fa fa-bars" aria-hidden="true"></i> Danh mục sản phẩm
                                    </div>
                                    <div class="cate_pro">
                                        <div id='cssmenu_flyout' class="display_destop_menu">
                                            <ul>
                                                <?php foreach($allcatlist as $key => $cat){
                                                    $cat_id_1 = $cat['catId'];
                                                 ?>
                                                <li class='active has-sub'>
                                                    <a href='#'><span><?php echo $cat['catName'] ?></span></a>

                                                    <div class="menu_sub_all">
                                                        <?php
                                                        foreach($allsubcatlist as $key => $cat1){ 
                                                            if($cat1['parent_id']==$cat_id_1){
                                                                $cat_id_2 = $cat1['catId'];
                                                        ?>
                                                         <a href='<?php echo BASE_URL ?>/t/category_all/<?php echo $cat1['catId'] ?>/<?php echo $help->makeUrl($cat1['catName']) ?>'><span style="color: #000;position: relative;font-size: 17px;font-weight: 700;"><?php echo $cat1['catName'] ?></span></a>
                                                       
                                                        <ul>
                                                             <?php
                                                                foreach($allsubcatlist as $key => $cat2){ 
                                                                    if($cat2['parent_id']==$cat_id_2){
                                                                        
                                                                ?>
                                                            <li>
                                                                <a href="<?php echo BASE_URL ?>/t/category/<?php echo $cat2['catId'] ?>/<?php echo $help->makeUrl($cat2['catName']) ?>"><?php echo $cat2['catName'] ?></a>
                                                            </li>
                                                             <?php
                                                                    }
                                                                } 
                                                                ?>
                                                           
                                                            <div class="clear"></div>
                                                        </ul>
                                                        <?php
                                                            }
                                                        } 
                                                        ?>
                                                    </div>
                                                     

                                                </li>
                                                <?php
                                                } 
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search_top">
                            <div id='cssmenu'>
                                <ul>
                                    <li class='active'><a href='<?php echo BASE_URL ?>'>Trang chủ</a></li>
                                    <?php
                                    foreach($onecatpost as $key => $catpost){ 
                                    ?>
                                    <li class=''><a href='<?php echo BASE_URL ?>/p/intro/<?php echo $catpost['id_onecatpost'] ?>/<?php echo $help->makeUrl($catpost['onecatpostName']) ?>'><?php echo $catpost['onecatpostName'] ?></a></li>
                                  
                                    <?php
                                    } 
                                    ?>
                                    <li class=''>
                                        <a href='#'>Sản phẩm</a>
                                        <ul>
                                             <?php
                                             foreach($allcatlist as $key => $cat3){
                                                    $cat_id_3 = $cat3['catId'];
                                                 ?>
                                                     <li><a href='#'><?php echo $cat3['catName'] ?></a>
                                              
                                                <ul>
                                                     <?php
                                                     foreach($allsubcatlist as $key => $cat4){
                                                          if($cat4['parent_id']==$cat_id_3){
                                                 ?>
                                                    <li><a href='<?php echo BASE_URL ?>/t/category_all/<?php echo $cat4['catId'] ?>/<?php echo $help->makeUrl($cat4['catName']) ?>'><?php echo $cat4['catName'] ?></a></li>
                                                  <?php
                                                    }
                                                  } 
                                                  ?>
                                                </ul>
                                            </li>
                                              <?php
                                                } 
                                            ?>

                                           
                                        </ul>
                                    </li>
                                    <li class=''><a href='<?php echo BASE_URL ?>/c'>Giỏ hàng</a></li>
                                    <li class=''><a href='<?php echo BASE_URL ?>/p/all'>Tin tức</a></li>
                                    <li class=''><a href='<?php echo BASE_URL ?>/p/contact'>Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
     </div>
    </header>
    <div class="clear"></div>