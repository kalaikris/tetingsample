 // Page Loader
// setTimeout(function(){$('#loading').fadeOut();},500);
// Tab action
$('.jurney-items').on('click',function(){
    $('.jurney-items').removeClass('active');
    $(this).addClass('active')
});

$('.mobile-nav-toggle').on('click',function(){
    $(`body`).toggleClass('nav-avtive');
})
$('.manage-item').on('click',function(){
    $(`body`).removeClass('nav-avtive');
})