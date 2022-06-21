(function() {   //변수 스코프 때문에 사용, 코드 충돌 없이 구현 가능
    const trList = document.querySelectorAll('tbody > tr');

    trList.forEach(item => {
        item.addEventListener('click', () => {
            location.href = `detail?i_board=${item.dataset.i_board}`;
        });
    });

    //dataset 사용방법 알기
    // const tr1 = trList[0];
    // console.log(tr1.dataset.iboard);
})();