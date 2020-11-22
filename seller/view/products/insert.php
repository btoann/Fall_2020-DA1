<form action="seller.php?ctrl=products&act=insert" method="post">
    <table>
        <tr>
            <td>Tên sản phẩm: </td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td>Danh mục: </td>
            <td>
                <select name="category" id="">
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
                            $out .= '<option value="'.$categories[$i]['name'].'">'.$categories[$i]['name'].'</option>';
                        }
                    }
                    $out .= '</optgroup>';

                    echo $out;

                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tên sản phẩm: </td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td>Số lượng: </td>
            <td><input type="number" name="amount" id=""></td>
        </tr>
    </table>
</form>