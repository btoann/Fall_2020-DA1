
<script src=".public/js/seller/products.js" defer></script>
<!-- <form action="seller.php?ctrl=products&act=insert" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><p>Tên sản phẩm: </p></td>
            <td><input type="text" name="name" id="name" required></td>
        </tr>
        <tr>
            <td><p>Danh mục: </p></td>
            <td>
            </td>
        </tr>
        <tr>
            <td><p>Phân loại: </p></td>
            <td>
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
</form> -->



<div class="center">
    <div class="center__content">
        <div class="center__title">Bảng điều khiển</div>
        <p class="center__desc">Thêm sản phẩm</p>
        <div class="center__formWrapper">
            <form action="seller.php?ctrl=products&act=insert" method="post" enctype="multipart/form-data">
                <div class="center__inputWrapper">
                    <label for="title">Tên sản phẩm</label>
                    <input type="text" name="name" placeholder="Tên sản phẩm" required>
                </div>
                <div class="center__inputWrapper">
                    <label for="p_category">Danh mục</label>
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
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="category">Phân loại</label>
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
                </div>
                <div class="center__inputWrapper">
                    <label for="image">Hình ảnh</label>
                    <input type="file" name="image[]" id="" multiple required>
                </div>
                <!-- <div class="center__inputWrapper">
                    <label for="image">Hình ảnh 2</label>
                    <input type="file">
                </div>
                <div class="center__inputWrapper">
                    <label for="image">Hình ảnh 3</label>
                    <input type="file"> -->
        </div>
        <div class="center__inputWrapper">
            <label for="title">Giá sản phẩm</label>
            <input type="number" name="price" id="" required>
        </div>
        <div class="center__inputWrapper">
            <label for="title">Khuyến mãi</label>
            <select name="promotion" id="category" required>
                <option value="0">--Không chọn--</option>
            <?php
                $output = '';
                foreach ($promotions as $promotion)
                {
                    $output .= '<option value="'.$promotion['id'].'">'.$promotion['name'].' [-'.$promotion['discount'].'%] ('.$promotion['begin'].' - '.$promotion['end'].')</option>';
                }
                echo $output;
            ?>
            </select>
        </div>
        <div class="center__inputWrapper">
            <label for="title">Số lượng</label>
            <input type="number" name="amount" id="" value="0">
        </div>
        <div class="center__inputWrapper">
            <label for="desc">Mô tả:</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" class="btn" name="insert" value="Thêm sản phẩm">
        </form>
    </div>
</div>