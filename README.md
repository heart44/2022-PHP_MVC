# 2022-PHP_MVC
# PHP_MVC

.htaccess 파일 생성

    Options -MultiViews
    RewriteEngine On
    Options -Indexes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-l
    RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]

#httpd.conf 파일 수정

주석 해제

LoadModule rewrite_module modules/mod_rewrite.so



<Directory "${SRVROOT}/htdocs">
    AllowOverride All

로 변경




#Controller 예시
use application\models\BoardModel;
 
 

    class BoardController extends Controller {
        public function index() {
            return $this->list();
        }

        public function list() {
            $model = new BoardModel();
            $list = $model->selBoardList();        

            $this->addAttribute("list", $list);
            return "board/list.php";
        }

        public function detail() {
            $css = ['board/index', 'board/detail'];
            $js = ['board'];
            $param = ["i_board" => $_GET["i_board"]];          
            $model = new BoardModel();
            $data = $model->selBoard($param);
            $this->addAttribute("data", $data);
            $this->addAttribute(_CSS, $css);
            $this->addAttribute(_JS, $js);
            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("board/detail.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
            return "template/t1.php";
        }

        public function delete() {
            $param = ["i_board" => $_GET["i_board"]];
            $model = new BoardModel();
            $model->delBoard($param);
            return "redirect:/board/list";
        }

        public function mod() {
            $param = ["i_board" => $_GET["i_board"]];
            $model = new BoardModel();
            $model->selBoard($param);
            $data = $model->selBoard($param);
            $this->addAttribute("data", $data);

            $this->addAttribute(_HEADER, $this->getView("template/header.php"));
            $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
            $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
            return "template/t1.php";
        }

        public function modProc() {
            $param = [
                "i_board" => $_POST["i_board"],
                "title" => $_POST["title"],
            ];
            $model = new BoardModel();
            $model->updBoard($param);
            return "redirect:/board/detail?i_board=" . $param["i_board"];
        }
    }





# Model 예시
    namespace application\models;
    use PDO;

    class BoardModel extends Model {

        public function selBoardList() {
            $sql = "SELECT i_board, title FROM t_board ORDER BY i_board DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selBoard(&$param) {
            $sql = "SELECT i_board, title, ctnt FROM t_board WHERE i_board = :i_board";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':i_board', $param["i_board"]);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function delBoard(&$param) {
            $sql = "DELETE FROM t_board WHERE i_board = :i_board";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':i_board', $param["i_board"]);
            return $stmt->execute();
        }

        public function updBoard(&$param) {
            $sql = "UPDATE t_board SET title = :title WHERE i_board = :i_board";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':title', $param["title"]);
            $stmt->bindValue(':i_board', $param["i_board"]);
            return $stmt->execute();
        }
    }

# View 예시
    <h1>디테일!!!</h1>

    <div><?=$this->data->i_board?></div>
    <div><?=$this->data->title?></div>



    <!DOCTYPE html>
    <html lang="en">
    <?php include_once "application/views/template/head.php"; ?>
    <body>
        <h1>게시판 목록 페이지 </h1>
        <a href="/board/writeView">글쓰기</a><br>
        <?php
            if (count($this->list) === 0) {
                echo '현재 작성된 글이 없습니다.<br>';
            } else {
                foreach ($this->list as $item) {
        ?>
            <a href="/board/detail?i_board=<?=$item->i_board; ?>"><h3>제목 : <?=$item->title;?></h3></a> 
        <?php   
                }
            }

        ?>
    </body>
    </html>


    <h1>디테일!!!</h1>

    <div><?=$this->data->i_board?></div>
    <div><?=$this->data->title?></div>

    <form action="/board/modProc" method="post">
        <input type="hidden" name="i_board" value="<?=$this->data->i_board?>">
        <div><input type="text" name="title" value="<?=$this->data->title?>"></div>
        <div><input type="submit" value="수정">
    </form>