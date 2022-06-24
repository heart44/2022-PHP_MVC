<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>

<body>
    <div id="container">
        <h1>디테일</h1>
        <?php if(isset($_SESSION[_LOGINUSER]) && $this->data->i_user === $_SESSION[_LOGINUSER]->i_user) { ?>
            <div>
                <button id="btnDel" data-i_board="<?= $this->data->i_board ?>">삭제</button>
                <a href="mod?i_board=<?= $this->data->i_board ?>"><button>수정</button></a>
            </div>
        <?php } ?>
        <hr>
        <div>    
            <div>글번호 : <?= $this->data->i_board ?></div>
            <div>제목 : <?= $this->data->title ?></div>
            <div>글쓴이 : <?= $this->data->nm ?></div>
            <div>작성일 : <?= dateFormat($this->data->created_at) ?></div>
            <hr>
            <div><?= $this->data->ctnt ?></div>
        </div>
        <hr>
        <div>
            <h3>댓글 <span><?= count($this->reData) ?></span></h3>
            <?php foreach($this->reData as $item) { ?> 
                <div>
                    <div><?= $item->nm ?></div>
                    <div><?= dateFormat($item->updated_at) ?></div>
                    <div><?= $item->ctnt ?></div>
                </div>
                <div>
                    <?php if(isset($_SESSION[_LOGINUSER]) && $item->i_user == $_SESSION[_LOGINUSER]->i_user) { ?>
                        <button id="modRe" data-i_re="<?= $item->i_re ?>">수정</button>
                        <button id="delRe" data-i_re="<?= $item->i_re ?>" data-i_board="<?= $this->data->i_board ?>">삭제</button>
                    <?php } ?>
                </div>
                <br>
            <?php } ?>
            <div>
                <form action="replyProc" method="POST">
                    <div><input type="hidden" name="i_board" value="<?= $this->data->i_board ?>"></div>
                    <div><textarea name="ctnt"></textarea></div>
                    <div><input type="submit" value="댓글등록"></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>