<?php
include_once('app/helper/Helper.php');
$help = new Helper();
?> 
<section>
        <div class="bg_in">
            <div class="module_pro_all">
                <div class="box-title">
                    <div class="title-bar">
                        <h1>Sản phẩm tìm thấy : <?php echo $this->key ?></h1>
                      
                    </div>
                </div>
                <div class="pro_all_gird">
                    <div class="girds_all list_all_other_page ">
                        <?php
                         foreach($search_product as $key => $search){ 
                        ?>

                        <div class="grids">
                            <div class="grids_in">
                                <div class="content">
                                    <div class="img-right-pro">

                                        <a href="<?php echo BASE_URL ?>/t/details/1">
                                            <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $search['image'] ?>" data-original="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $search['image'] ?>" alt="<?php echo $help->makeUrl($search['productName']) ?>" />
                                        </a>

                                        <div class="content-overlay"></div>
                                        <div class="content-details fadeIn-top">
                                            <?php
                                            echo $search['sum_text']; 
                                            ?>
                                         
                                        </div>
                                    </div>
                                    <div class="name-pro-right">
                                        <a href="<?php echo BASE_URL ?>/t/details/<?php echo $search['productId'] ?>/<?php echo $help->makeUrl($search['productName']) ?>">
                                            <h3><?php echo $search['productName'] ?></h3>
                                        </a>
                                    </div>
                                    <div class="add_card">
                                         <input type="hidden" name="hidden_name" id="quantity<?php echo $search['productId']  ?>" value="1" />
                                          <input type="hidden" name="hidden_name" id="name<?php echo $search['productId']  ?>" value="<?php echo $search['productName']  ?>" />
                                          <input type="hidden" name="hidden_name" id="image<?php echo $search['productId']  ?>" value="<?php echo $search['image']  ?>" />
                                           <input type="hidden" name="hidden_price" id="price<?php echo $search['productId']  ?>" value="<?php echo $search['price']  ?>" />

                                        <input type="button" name="add_to_cart_home" id="<?php echo $search['productId'] ?>" class="btn-styling-cart add_to_cart" value="Đặt hàng" /> 
                                       
                                    </div>
                                    <div class="price_old_new">
                                        <div class="price">
                                            <span class="news_price"><?php echo $help->format_currency($search['price']).'đ' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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