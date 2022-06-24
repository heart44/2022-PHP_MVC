<?php
namespace application\models;   //같은 namespace면 use 안해도 됨
use PDO;

class BoardModel extends Model {
    public function insBoard(&$param) {
        $sql = "INSERT INTO t_board (title, ctnt, i_user)
                VALUES (:title, :ctnt, :i_user)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->bindValue(':i_user', $param["i_user"]);
        $stmt->execute();
    }

    public function selBoardList() {
        $sql = "SELECT b.*, u.nm
                FROM t_board b, t_user u
                WHERE b.i_user = u.i_user
                ORDER BY i_board desc";
        
        //stmt : 쿼리문 실행, 문장 완료
        $stmt = $this->pdo->prepare($sql);  //prepare : 문장에서 우리가 쿼리문의 내용이 바껴야할 때 사용, 문자열인지 알아서 판단해줌
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selBoard(&$param) {
        $sql = "SELECT b.*, u.nm 
                FROM t_board b, t_user u
                WHERE b.i_user = u.i_user and i_board = :i_board";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updBoard(&$param) {
        $sql = "UPDATE t_board
                SET title = :title, ctnt = :ctnt, updated_at = now()
                WHERE i_board = :i_board";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        return $stmt->execute();
    }
    
    public function delBoard(&$param) {
        $sql = "DELETE FROM t_board WHERE i_board = :i_board";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        return $stmt->execute();
    }

    public function insReply(&$param) {
        $sql = "INSERT INTO t_reply (ctnt, i_user, i_board, rv)
                VALUES (:ctnt, :i_user, :i_board, :rv)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->bindValue(':i_user', $param["i_user"]);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->bindValue(':rv', $param["rv"]);
        $stmt->execute();
    }

    public function selReply(&$param) {
        $sql = "SELECT r.*, u.nm
                FROM t_reply r, t_user u
                WHERE r.i_user = u.i_user and i_board = :i_board";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delReply(&$param) {
        $sql = "DELETE FROM t_reply 
                WHERE i_board = :i_board and i_re = :i_re";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->bindValue(':i_re', $param["i_re"]);
        $stmt->execute();
    }

    public function viewCnt(&$param) {
        $sql = "UPDATE t_board
                SET view_cnt = view_cnt + 1
                WHERE i_board = :i_board";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();
    }
}