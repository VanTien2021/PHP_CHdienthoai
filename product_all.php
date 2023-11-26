<?php
include_once('app/helper/Helper.php');
$help = new Helper();
?> 
<section>
        <div class="bg_in">
            
              <?php
                    foreach($select_cate_by_id as $key => $cat){ 
                        $id_cat = $cat['catId'];
            ?>
            <div class="module_pro_all">
                <div class="box-title">
                    <div class="title-bar">
                        <h1><?php echo $cat['catName'] ?></h1>
                    
                            </div>
                </div>
                <?php
                 
                ?>
                <div class="pro_all_gird">
                    <div class="girds_all list_all_other_page ">
                       <?php
                            foreach($allproduct as $key => $product){ 
                                if($product['catId']==$id_cat){
                            ?>
                        <div class="grids">
                           
                            <div class="grids_in">
                                <div class="content">
                                    <div class="img-right-pro">

                                        <a href="<?php echo BASE_URL ?>/t/details/1">
                                            <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $product['image'] ?>" data-original="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $product['image'] ?>" alt="<?php echo $help->makeUrl($product['productName']) ?>" />
                                        </a>

                                        <div class="content-overlay"></div>
                                        <div class="content-details fadeIn-top">
                                            <?php
                                            echo $product['sum_text']; 
                                            ?>
                                         
                                        </div>
                                    </div>
                                    <div class="name-pro-right">
                                        <a href="<?php echo BASE_URL ?>/t/details/<?php echo $product['productId'] ?>/<?php echo $help->makeUrl($product['productName']) ?>">
                                            <h3><?php echo $product['productName'] ?></h3>
                                        </a>
                                    </div>
                                    <div class="add_card">
                                        <input type="hidden" name="hidden_name" id="quantity<?php echo $product['productId']  ?>" value="1" />
                                          <input type="hidden" name="hidden_name" id="name<?php echo $product['productId']  ?>" value="<?php echo $product['productName']  ?>" />
                                          <input type="hidden" name="hidden_name" id="image<?php echo $product['productId']  ?>" value="<?php echo $product['image']  ?>" />
                                           <input type="hidden" name="hidden_price" id="price<?php echo $product['productId']  ?>" value="<?php echo $product['price']  ?>" />

                                        <input type="button" name="add_to_cart_home" id="<?php echo $product['productId'] ?>" class="btn-styling-cart add_to_cart" value="Đặt hàng" /> 
                                    </div>
                                     <div class="price_old_new">
                                        <div class="price">
                                            <span class="news_price"><?php echo $help->format_currency($product['price']).'đ' ?></span>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        
                        </div>
                                <?php
                        }
                            } 
                            ?>
                      
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
              <?php
            
              ?>
                <div class="clear"></div>
            </div>
              <?php
                 } 
                ?>
    </section>
    <!--end:body-->
    <div class="clear"></div>