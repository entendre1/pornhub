let library = new Set();
let counter = 0;
let cats;
let cats_toogle = false;
let modal_help_shown = false;

let preset_launch_show = false;

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

//MAIN MENU LAUNCH BUTTON
$(document).on('click','#launch-btn',function(){
    cats = Array.from(library);
    var cats_str = cats.join(',');
    $('#launch-input').attr('name','included_cats');
    $('#launch-input').attr('value',cats_str);
    $('#launch-form').submit();

});

let popperInstance = null;
let button;
let tooltip;
function create() {
    popperInstance = Popper.createPopper(button, tooltip, {
        modifiers: [
        {
            name: 'offset',
            options: {
            offset: [0, 8],
            },
        },
        ],
    });
}
function destroy() {
    if (popperInstance) {
      popperInstance.destroy();
      popperInstance = null;
    }
  }
  function show() {
    tooltip.setAttribute('data-show', '');
    create();
  }

  function hide() {
    tooltip.removeAttribute('data-show');
    destroy();
  }

//PRESET ON HOLD  - DESCRIPTION OF PRESET POPPER
  $(document).on('taphold','.preset',function(){
    $('#tooltip_text').text($(this).data('description'));
    button = this;
    tooltip = $("#tooltip")[0];
    show();
    setTimeout(hide,1000);

});

//PRESETS MODAL HELP
$(document).on('click','.control[rel]',function(){
    if (!modal_help_shown){
        button = $('.preset')[0];
        tooltip = $("#tooltip")[0];
        $('#tooltip_text').text(HELP_MODAL_DESCRIPTION);
        show();
        setTimeout(hide,2000);
        modal_help_shown = true;
    }
    if(preset_launch_show){
        $('#preset-launch-btn').show();
    }   
});

//CHOOSE ONLY ONE PRESET
$(document).on('tap','.preset',function(){
    let current = this;
    $('.preset').each(function(index){
        if ($('.preset')[index] != current){
            $(this).removeClass('preset-choosen')
        }
    });
    $(this).toggleClass('preset-choosen');

    if ($(this).hasClass('preset-choosen')){
        preset_launch_show = true;
        $('#preset-launch-btn').show();
    } else {
        preset_launch_show = false;
        $('#preset-launch-btn').hide();
    }


});

//LAUNCH PRESET
$(document).on('tap','#preset-launch-btn',function(){
    $('#launch-input').attr('name','included_cats');
    $('#launch-input').attr('value',$('.preset-choosen').data('cats'));
    $('#launch-form').submit();
});
$(document).on('tap','.close-modal',function(){
    $('#preset-launch-btn').hide();
});