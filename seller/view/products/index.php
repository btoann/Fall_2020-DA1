<p></p>
<p>
    <a href="seller.php?ctrl=products&act=insert">Thêm</a>
    &ensp;
    <a href="seller.php?ctrl=products&act=edit">Sửa</a>
    &ensp;
    <a href="seller.php?ctrl=products&act=del">Xoá</a>
</p>
<p></p>
<table border="1">
    <thead>
        <td><strong>#</strong></td>
        <td><strong>Tên sản phẩm</strong></td>
        <td><strong>Danh mục</strong></td>
        <td><strong>Phân loại</strong></td>
        <td><strong>Giá cũ</strong></td>
        <td><strong>Giá mới</strong></td>
        <td><strong>Ngày đăng</strong></td>
        <td><strong>Lượt mua</strong></td>
    </thead>
    <tbody>

        <?php

            foreach($basic_products as $product)
            {
                $categories_hashtag = ($product['categories_hashtag'] != NULL)
                                    ? catHashtag_byProduct($product['categories_hashtag'])
                                    : NULL;
                echo
                    '<tr>
                        <td>'.$product['id'].'</td>
                        <td>'.$product['product_name'].'</td>
                        <td>'.$product['category_name'].'</td>
                        <td>'.implode('&ensp;', $categories_hashtag['name']).'</td>
                        <td>'.$product['old_price'].'</td>
                        <td>%</td>
                        <td>'.$product['date'].'</td>
                        <td>?</td>
                    </tr>';
            }

        ?>

    </tbody>
</table>