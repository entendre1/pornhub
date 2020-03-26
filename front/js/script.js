let library = new Set();
let counter = 0;
let cats;
let cats_toogle = false;
let modal_help_shown = false;

//Category click
$(document).on('mouseup','.cat',function(){
    $(this).toggleClass('cat-choosen');
    categoryOnClick(this);
});

//MAIN MENU ALL OR FEATURED CATS CHOOSE
$(document).on('mouseup','#categories_toggle',function(){
    console.log('Toggle Сategories');
    $(this).toggleClass('button-choosen');
    cats_toogle = !cats_toogle;
    if (cats_toogle){
    //ALL CATEGORIES
        $('#featured_list').hide();
        $('#all_list').show();
        $(this).text($(this).data('locale-featured'));
    } else {
    //FEATURED CATEGORIES
        $('#featured_list').show();
        $('#all_list').hide();
        $(this).text($(this).data('locale-all'));
}
})
function categoryOnClick(element){
    if ($(element).hasClass('cat-choosen')){
        library.add($(element).data('category'));
        counter++;
    } else {
        library.delete($(element).data('category'));
        counter--;
    }
    if (counter >= 1){
        $('#launch-btn').show();
    }
    if (counter == 0){
        $('#launch-btn').hide();
    }

}
function launch(cats_str = null){
    if (cats_str){
        $('#launch-input').attr('name','included_cats');
        $('#launch-input').attr('value',cats_str);
        $('#launch-form').submit();
    }else{
        $('#launch-form').submit();
    }
}
//MAIN MENU LAUNCH BUTTON
$(document).on('click','#launch-btn',function(){
    cats = Array.from(library);
    var cats_str = cats.join(',');
    launch(cats_str);

});
//CROSSROAD BACK-BTN
$(document).on('click','#back-to-crossroad',function(){
    $('#crossroad').show();
    $('body').addClass('stop-scrolling');
});


//CHAPTERS
//18-QUESTION
$(document).on('click','#18-control',function(){
    $('#age-overlay').hide();
    $('#crossroad').show();
});
//CROSSROAD
//-RANDOM
$(document).on('click','#crossroad-random',function(){
    launch();
})
//-CLASSIC
$(document).on('click','#crossroad-classic',function(){
    $('#featured_list').html($('#service-popularClassic').html());
    $('#crossroad').hide();
    $('body').removeClass('stop-scrolling');
});
//-GAY
$(document).on('click','#crossroad-gay',function(){
    $('#featured_list').html($('#service-popularGay').html());
    $('#crossroad').hide();
    $('body').removeClass('stop-scrolling');
});
