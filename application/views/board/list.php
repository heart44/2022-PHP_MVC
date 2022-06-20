<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>리스트</h1>
    <table>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>
        <?php
            foreach($this->list as $item) { 
        ?> 
            <tr>
                <td><?= $item->i_board ?></td>
                <td><?= $item->title ?></td>
                <td><?= $item->created_at ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>