(function() {  
    //글삭제 
    const btnDel = document.querySelector('#btnDel');
    if(btnDel) {

        btnDel.addEventListener('click', () => {
            if(confirm('삭제하시겠습니까?')) {
                location.href = `del?i_board=${btnDel.dataset.i_board}`;
            }
        });
    }

    //댓글삭제
    const delBtn = document.querySelectorAll('#delRe');
    delBtn.forEach(element => {
        element.addEventListener('click', () => {
            if(confirm("삭제하시겠습니까?")) {
                location.href = `reDel?i_board=${element.dataset.i_board}&i_re=${element.dataset.i_re}`;
            }
        });
    });
})();