

$('.detailsCollapse').click(function(e){
    const id = (e.target.id).split("_")
    // $(`#collapse_${id[1]}`).toggleClass('icon-up-1 icon-down-1 ');

    const real_id = `#collapse_${id[1]}`;
    console.log(real_id)

    if ($(real_id).hasClass('icon-down-1')  ){
        $(real_id).removeClass('icon-down-1');
        $(real_id).addClass('icon-up-1');
        console.log('IM IN 1')
    }else if ($(real_id).hasClass('icon-up-1') ) {
        $(real_id).removeClass('icon-up-1');
        $(real_id).addClass('icon-down-1');
        console.log('IM IN 2')
    }

});