let library = new Set();
let counter = 0;
let cats;


//Category click
$(document).on('mouseup','.cat',function(){
    $(this).toggleClass('cat-choosen');
    categoryOnClick(this);
});
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

$(document).on('click','#launch-btn',function(){
    cats = Array.from(library);
    var cats_str = cats.join(',');
    $('#launch-input').attr('name','included_cats');
    $('#launch-input').attr('value',cats_str);
    $('#launch-form').submit();

});