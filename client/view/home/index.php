<!-- Danh sách danh mục-->
<h4>Danh mục lớn:</h4>
<ul>

    <?php
    
        foreach($categories_0 as $category)
        {
            echo '<li><a href="index.php?ctrl=categories&id='.$category['id'].'">'.$category['name'].'</li>';
        }

    ?>

</ul>
