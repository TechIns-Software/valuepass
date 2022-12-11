$('.detailsCollapse').click(function (e) {
    const id = (e.target.parentElement.parentElement.children[0].id).split("_");
    // $(`#collapse_${id[1]}`).toggleClass('icon-up-1 icon-down-1 ');
    const real_id = `#collapse_${id[1]}`;
    const spanDisplay = document.getElementById(`collapse1Span${id[1]}`);
    const spanHide = document.getElementById(`collapse2Span${id[1]}`);
    if ($(real_id).hasClass('icon-down-1')) {
        $(real_id).removeClass('icon-down-1');
        $(real_id).addClass('icon-up-1');

        spanDisplay.classList.add('displayNone')
        spanHide.classList.remove('displayNone')
        console.log('in', id[1], "1");
    } else {
        $(real_id).removeClass('icon-up-1');
        $(real_id).addClass('icon-down-1');

        spanDisplay.classList.remove('displayNone')
        spanHide.classList.add('displayNone')
        console.log('in', id[1], "2");
    }


});
