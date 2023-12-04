  <div class="info_top">

            <div class="bg_in">

                <p class="p_infor">

                    <span><i class="fa fa-envelope-o" aria-hidden="true"></i>Email: 3tphoneshop@gmail.com</span>

                    <span><i class="fa fa-phone" aria-hidden="true"></i> Hotline: 0333.387.339 - 07777.38.430</span>

                </p>

            </div>

        </div>

        <div class="header_top_menu">

            <div class="header_top_menu_all">

                <div class="header_top">

                    <div class="bg_in">

                        <div class="logo">

                            <?php

                            foreach($info as $key => $logo){ 

                            ?>

                            <a href="<?php echo BASE_URL ?>"><img src="<?php echo BASE_URL ?>/teamplate/image/<?php echo $logo['logo'] ?>" width="300" height="150" alt="Logo 3tphone" /></a>

                            <?php

                            } 

                            ?>

                        </div>

                        <nav class="menu_top">

                            <form class="search_form" method="get" action="<?php echo BASE_URL ?>/t/search">

                                <input class="searchTerm" name="search" placeholder="Nhập sản phẩm cần tìm..." />

                                <button class="searchButton" type="submit">

                                    <i class="fa fa-search" aria-hidden="true"></i>

                                </button>

                            </form>

                        </nav>

                        <div class="cart_wrapper">

                            <div class="cols_100">

                                <div class="hot_line_top">

                                    <span><b>Trụ sở chính</b></span>

                                    <br/>

                                    <span class="red">244A Nguyễn Văn Luông, Phường 11, Quận 6, TP.HCM</span>

                                </div>

                            </div>

                          

                            <div class="clear"></div>

                        </div>

                        <div class="clear"></div>

                    </div>

                </div>

            </div>