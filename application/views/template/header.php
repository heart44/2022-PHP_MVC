<h3>header</h3>
<div>
    <?php if(isset($_SESSION[_LOGINUSER])) { ?>
        <a href="/board/write"><button>글쓰기</button></a>
        <a href="/user/logout"><button>로그아웃</button></a>
    <?php } else { ?>
        <a href="/user/login"><button>로그인</button></a>
        <a href="/user/join"><button>회원가입</button></a>
    <?php } ?>
    <a href="/board/list"><button>리스트</button></a>
</div>