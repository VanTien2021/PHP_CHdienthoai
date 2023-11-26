<?php

include_once('app/helper/Helper.php');

$help = new Helper();

?> 

<section>



        <div class="bg_in">

            <div class="module_pro_all">

                <div class="box-title">

                    <div class="title-bar">

                        <h1>Sản phẩm HOT</h1>

                      

                    </div>

                </div>

                <div class="pro_all_gird">

                    <div class="girds_all list_all_other_page ">

                     

                        <div class="slider responsive">

                               <?php

                             foreach($product_feathered as $key => $feather){ 

                            ?>

                              <div>

                            

                                <div class="content">
                               
                                    <div class="img-right-pro">



                                        <a href="<?php echo BASE_URL ?>/t/details/1">

                                            <img class="lazy img-pro content-image" src="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $feather['image'] ?>" data-original="<?php echo BASE_URL ?>/teamplate/image/product/<?php echo $feather['image'] ?>" alt="<?php echo $help->makeUrl($feather['productName']) ?>" />

                                        </a>



                                        <div class="content-overlay"></div>

                                        <div class="content-details fadeIn-top">

                                            <?php

                                            echo $feather['sum_text']; 

                                            ?>

                                         

                                        </div>

                                    </div>
                        
                                    <div class="name-pro-right">

                                        <a href="<?php echo BASE_URL ?>/t/details/<?php echo $feather['productId'] ?>/<?php echo $help->makeUrl($feather['productName']) ?>">

                                            <h3><?php echo $feather['productName'] ?></h3>

                                        </a>

                                    </div>

                                    <div class="add_card">

                                        <input type="hidden" name="hidden_name" id="quantity<?php echo $feather['productId']  ?>" value="1" />

                                          <input type="hidden" name="hidden_name" id="name<?php echo $feather['productId']  ?>" value="<?php echo $feather['productName']  ?>" />

                                          <input type="hidden" name="hidden_name" id="image<?php echo $feather['productId']  ?>" value="<?php echo $feather['image']  ?>" />

                                           <input type="hidden" name="hidden_price" id="price<?php echo $feather['productId']  ?>" value="<?php echo $feather['price']  ?>" />



                                        <input type="button" name="add_to_cart_home" id="<?php echo $feather['productId'] ?>" class="btn-styling-cart add_to_cart" value="Đặt hàng" /> 

                                    </div>
                                    <a href="<?php echo BASE_URL ?>/t/details/<?php echo $feather['productId'] ?>/<?php echo $help->makeUrl($feather['productName']) ?>">
                                     <div class="price_old_new">

                                        <div class="price">

                                            <span class="news_price"><?php echo $help->format_currency($feather['price']).'đ' ?></span>

                                        </div>

                                    </div> 
                                    </a>
                                </div>

                           

                              </div>

                         

                         <?php

                        } 

                        ?>

                        </div>

                

                   

                       

                        <div class="clear"></div>

                    </div>

                    <div class="clear"></div>

                </div>

                <div class="clear"></div>

            </div>

              <?php

                    foreach($allcatlist as $key => $cat){ 

                        $id_cat = $cat['catId'];



            ?>

            <div class="module_pro_all">

                <div class="box-title">

                    <div class="title-bar">

                        <h1><?php echo $cat['catName'] ?></h1>

                   </div>

                </div>

              <!--   <button  value="<?php echo $cat['catId'] ?>" class="btn btn-default btn-filter-all">Xem tất cả</button> -->

            <?php 

                 foreach($allsubcatlist as $key => $cat4){  

                                 if($cat4['parent_id']==$id_cat){

                                     $id_cat4 = $cat4['catId'];

                                         foreach($allsubcatlist as $key => $cat5){  

                                             if($cat5['parent_id']==$id_cat4){

                ?>



                <button data-cate="<?php echo $cat['catId'] ?>" value="<?php echo $cat5['catId'] ?>" class="btn btn-default btn-filter"><?php echo $cat5['catName'] ?></button>

                <?php

                            }

                        }

                    }

                } 

                ?>

                <p id="fetch_home_<?php echo $cat['catId'] ?>"></p> 

               

                

                <div class="clear"></div>

                <!------------------All cate---------------------------->

                 <div class="pro_all_gird" id="pro_all_gird_<?php echo $cat['catId'] ?>">



                    <div class="girds_all list_all_other_page ">

                         <div class="slider responsive">



                         <?php



                             foreach($allsubcatlist as $key => $cat2){  



                                 if($cat2['parent_id']==$id_cat){



                                     $id_cat2 = $cat2['catId'];



                                         foreach($allsubcatlist as $key => $cat3){  



                                             if($cat3['parent_id']==$id_cat2){



                                                 $id_cat3 = $cat3['catId']; 

                                                     $i = 0;

                                                        foreach($allproduct as $key => $product){

                                                           $i++;

                                                             if($product['catId']==$id_cat3){

                                                                 

                         ?>



                      

                            <div>

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


                                     <a href="<?php echo BASE_URL ?>/t/details/<?php echo $feather['productId'] ?>/<?php echo $help->makeUrl($feather['productName']) ?>">
                                     <div class="price_old_new">



                                        <div class="price">



                                            <span class="news_price"><?php echo $help->format_currency($product['price']).'đ' ?></span>



                                        </div>



                                    </div> 
                                    </a>


                                </div>

                        </div>

                          



                              <?php

                          }



                            }



                                }



                                }  



                            



                        }



                    }



                  



                ?>



                      



                        <div class="clear"></div>



                    </div>



                    <div class="clear"></div>

                </div>

                </div>

            </div>

              <?php

                 } 

                ?>

    </section>

    <!--end:body-->

    <div class="clear"></div>