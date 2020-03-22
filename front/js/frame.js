$(document).on('click','.mhp1138_play',function(){
    alert('hui');
});
setTimeout(() => { 

    //var link = $('#main_frame').contents().find('source')[0];
    var vars = document.getElementById("main_frame").contentWindow.flashvars;
    var link = vars.mediaDefinitions[0].videoUrl;
    console.log(link);
    $('#main_player_source').attr('src',link);
    const player = new Plyr('#main_player');
    
}, 1000); 

