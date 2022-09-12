<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>d11</title>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <style>
        .disabled {
            background-color: #AAB2C3;
        }
        .active {
            background-color: #214462;
        }
        .btn-primary {
            background-color: #0474D7 !important;
        }
    </style>
</head>
<body>
    <?php
        $data = json_decode(file_get_contents('data.json'));
        $max_page = ceil(sizeof($data)/5,);
        
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $startPage = $page-2;
        $endPage = $page+2;
        if ($startPage < 1) {
            $startPage = 1;
            $endPage = 5;
        }
        if ($endPage > $max_page) {
            $startPage = $max_page - 5 + 1;
            $endPage = $max_page;
        }

        $page_data = array_slice($data, ($page-1)*5, 5);

        ?>
            <table class="table">
                <thead>
                    <tr>
                        <?php foreach($data[0] as $head => $s): ?>
                            <th><?php echo $head; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($page_data as $item): ?>
                        <tr>
                            <?php foreach($item as $in): ?>
                            <td>
                                <?php echo $in; ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php

    ?>

    <a href="?page=<?php echo ($page==1)? $page: $page-1; ?>" class='btn <?php echo ($page==1)? "btn-secondary": "btn-primary" ?>'>&lt;</a>
    
    <?php for($i=$startPage; $i <= $endPage; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class='btn <?php echo ($page==$i)?"btn-primary": ""?>'> <?php echo $i; ?></a>
    <?php endfor; 
        
    ?>
    <a href="?page=<?php echo ($page==$max_page)? $page: $page+1; ?>" class='btn <?php echo ($page==$max_page)? "btn-secondary": "btn-primary" ?>'>&gt;</a>
</body>
</html>