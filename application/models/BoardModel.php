<?php
namespace application\models;   //같은 namespace면 use 안해도 됨
use PDO;

class BoardModel extends Model {
    public function selBoardList() {
        $sql = "SELECT * FROM t_board
                ORDER BY i_board desc";
        
        $stmt = $this->pdo->prepare($sql);  //prepare : 문장에서 우리가 쿼리문의 내용이 바껴야할 때 사용, 문자열인지 알아서 판단해줌
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}