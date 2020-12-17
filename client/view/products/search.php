
    <div class="container-px-0">
        <div class="row-container-product">
            <div class="title-sale">
            <span style="font-size: 22px"><strong><i class="fas fa-search"></i>&ensp;Kết quả tìm kiếm</strong></span>
            </div>

            <div id="London" class="tabcontent active">
                <div class="col-bg-dark">

                <?php

                    foreach($search_result as $search)
                    {
                        $new_price = ($search['type_pmt'] == 1) ? ($search['price'] * $search['discount'] * 0.01) : ($search['price'] - $search['discount']);
                        $discount = ($search['type_pmt'] == 1) ? $search['discount'] : (($search['discount'] / $search['price']) * 100);
                        echo
                        '<div class="box-product">
                            <a href="index.php?ctrl=products&act=detail&id='.$search['id'].'">
                                <div class="product">
                                    <div class="product-image">
                                    <img class="iphone" src=".public/images/products/p_'.$search['id'].'/'.$search['basename'].'" alt=""/>
                                    </div>
                                    <div class="product-information">
                                    <p>
                                        <a class="product-link" href="index.php?ctrl=products&act=detail&id='.$search['id'].'"><strong>'.$search['name'].'</strong></a>
                                    </p>
                                    <p class="product-price">'.$new_price.'đ&ensp;<del>'.$search['price'].'đ</del></p>
                                    </div>
                                    <div class="sale">
                                    <div class="sale-item">'.$discount.'%</div>
                                    <div class="triangle"></div>
                                    </div>
                                </div>
                            </a>
                        </div>';
                    }

                ?>

            </div>
        </div>
    </div>
