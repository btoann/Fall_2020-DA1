<p></p>
<p>
    <a href="seller.php?ctrl=products&act=insert">Thêm</a>
    &ensp;
    <a href="seller.php?ctrl=products&act=edit">Sửa</a>
    &ensp;
    <a href="seller.php?ctrl=products&act=delete">Xoá</a>
</p>
<p></p>
<table border="1">
    <thead>
        <td>
            <strong><em>Chọn</em></strong>
        </td>
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
                $categories_hashtag = (!empty($product['categories_hashtag']))
                                    ? catHashtag_byProduct($product['categories_hashtag'])
                                    : NULL;
                $name_ofHashtags = ($categories_hashtag != NULL) ? implode(' | ', array_column($categories_hashtag, 'name')) : '';
                echo
                    '<tr>
                        <td><input type="checkbox" id="" name="choices[]" value="'.$product['id'].'" form="delete_form"></td>
                        <td>'.$product['id'].'</td>
                        <td>'.$product['product_name'].'</td>
                        <td>'.$product['category_name'].'</td>
                        <td>'.$name_ofHashtags.'</td>
                        <td>'.$product['old_price'].'</td>
                        <td>%</td>
                        <td>'.$product['date'].'</td>
                        <td>'.$product['purchase'].'</td>
                    </tr>';
            }

        ?>

    </tbody>
</table>
<form action="seller.php?ctrl=products&act=delete" method="post" id="delete_form">
    <input type="submit" name="delete" value="Xoá">
</form>