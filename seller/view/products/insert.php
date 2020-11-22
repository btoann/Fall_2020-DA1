<script src=".public/js/seller/products.js" defer></script>
<form action="seller.php?ctrl=products&act=insert" method="post">
    <table>
        <tr>
            <td><p>Tên sản phẩm: </p></td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td><p>Danh mục: </p></td>
            <td>
                <select name="category" id="category">
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
                <div id="category_hashtag"></div>
            </td>
        </tr>
        <tr>
            <td><p>Tên sản phẩm: </p></td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td><p>Số lượng: </p></td>
            <td><input type="number" name="amount" id=""></td>
        </tr>
    </table>
</form>