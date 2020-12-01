<p></p>
<p>
    <a href="seller.php?ctrl=products&act=insert">Thêm</a>
    &ensp;
    <a href="seller.php?ctrl=products&act=edit">Sửa</a>
    &ensp;
    <a href="seller.php?ctrl=products&act=delete">Xoá</a>
</p>
<p></p>
<script src=".public/js/seller/products.js" defer></script>
<form action="seller.php?ctrl=products&act=insert" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><p>Tên sản phẩm: </p></td>
            <td><input type="text" name="name" id="name" required></td>
        </tr>
        <tr>
            <td><p>Danh mục: </p></td>
            <td>
                <select name="category" id="category" required>
                <?php

                    $out = '';
                    for($i = 0; $i < count($categories); $i++)
                    {
                        if($categories[$i]['depth'] == 0)
                        {
                            $out .= ($i == 0) ? '' : '</optgroup>';
                            $out .= '<optgroup label="'.$categories[$i]['name'].'">';
                        }
                        else
                        {
                            $out .= '<option value="'.$categories[$i]['id'].'">'.$categories[$i]['name'].'</option>';
                        }
                    }
                    $out .= '</optgroup>';

                    echo $out;

                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><p>Phân loại: </p></td>
            <td>
                <div id="category_hashtag">
                <?php
                    $output = '';
                    foreach ($hashtags as $hashtag)
                    {
                        $output .=
                        '<input type="checkbox" id="" name="hashtag[]" value="'.$hashtag['id'].'">
                        <label for="">'.$hashtag['name'].'</label>&ensp;';
                    }
                    echo $output;
                ?>
                </div>
            </td>
        </tr>
        <tr>
            <td><p>Hình ảnh: </p></td>
            <td><input type="file" name="image[]" id="" multiple required></td>
        </tr>
        <tr>
            <td><p>Giá sản phẩm: </p></td>
            <td><input type="number" name="price" id="" required></td>
        </tr>
        <tr>
            <td><p>Số lượng: </p></td>
            <td><input type="number" name="amount" id="" value="0"></td>
        </tr>
        <tr>
            <td><p>Mô tả: </p></td>
            <td><textarea name="description" id="" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                <button name="insert" type="submit" value="Thêm sản phẩm">Thêm sản phẩm</button>
            </td>
        </tr>
    </table>
</form>