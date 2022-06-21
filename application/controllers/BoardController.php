<?php
namespace application\controllers;
use application\models\BoardModel;

class BoardController extends Controller {
    public function list() {
        $model = new BoardModel();
        // $this->list = $model->selBoardList();
        $this->addAttribute("list", $model->selBoardList()); //위랑 같은 내용임
        $this->addAttribute("title", "리스트");
        $this->addAttribute("js", ["board/list"]);

        return "board/list.php";      //view 파일명
    }

    public function detail() {
        $i_board = $_GET["i_board"];

        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute("title", "디테일");
        $this->addAttribute("js", ["board/detail"]);

        // $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        // $this->addAttribute(_MAIN, $this->getView("board/detail.php?i_board={$i_board}"));
        // $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));

        return "board/detail.php";
    }

    public function del() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->delBoard($param));

        return "redirect:/board/list";
    }

    public function mod() {
        $i_board = $_GET["i_board"];

        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));

        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));

        return "template/t1.php";
    }

    public function modProc() {
        $i_board = $_POST["i_board"];
        print $i_board;
        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];

        $model = new BoardModel();
        $param = [
            "i_board" => $i_board,
            "title" => $title,
            "ctnt" => $ctnt
        ];
        $this->addAttribute("data", $model->updBoard($param));

        // $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        // $this->addAttribute(_MAIN, $this->getView("board/detail.php?i_board={$i_board}"));
        // $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));

        return "redirect:/board/detail?i_board={$i_board}";
    }
}