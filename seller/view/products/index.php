
<div class="center">
    <div class="center__content">
        <div class="center__title">Bảng điều khiển</div>
        <p class="center__desc">Xem sản phẩm</p>
        <div class="center__table">
            <div class="center__tableWrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Phân loại</th>
                            <th>Giá gốc</th>
                            <th>Giá niêm yết</th>
                            <th>Ngày đăng tải</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <?php

                                $output = '';
                                foreach($basic_products as $product)
                                {
                                    $promotion = get_promotion($product['promotion']);
                                    $promotion_price = $product['old_price'] - ($product['old_price'] * ($promotion['discount'] / 100));
                                    $categories_hashtag = (!empty($product['categories_hashtag']))
                                                        ? catHashtag_byProduct($product['categories_hashtag'])
                                                        : NULL;
                                    $name_ofHashtags = ($categories_hashtag != NULL) ? implode(',<br>', array_column($categories_hashtag, 'name')) : '';
                                    $output .=
                                        '<td data-label="STT">'.$product['id'].'</td>
                                        <td data-label="Tên sản phẩm">'.$product['product_name'].'</td>
                                        <td data-label="Danh mục">'.$product['category_name'].'</td>
                                        <td data-label="Phân loại">'.$name_ofHashtags.'</td>
                                        <td data-label="Giá gốc">'.$product['old_price'].' ₫</td>
                                        <td data-label="Giá niêm yết">'.$promotion_price.' ₫</td>
                                        <td data-label="Ngày đăng">'.$product['date'].'</td>
                                        <td data-label="Sửa" class="center__iconTable">
                                            <a href=""><img src="assets/icon-edit.svg" alt=""></a>
                                        </td>
                                        <td data-label="Xoá" class="center__iconTable">
                                            <a href=""><img src="assets/icon-trash-black.svg" alt=""></a>
                                        </td>';
                                }
                                echo $output;

                            ?>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>