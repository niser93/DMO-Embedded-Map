$(window).on('load', function(){
    if( $('#bigmap').length )
    {
        $('#bigmap').css('display', 'flex').html(
            '<iframe style="flex-grow: 1; border: none; margin: 0; padding: 0;" src="https://www.google.com/maps/d/embed?mid=1WAJTbJqiQwrTpGF1PUjsE3DreaHFcYA&ehbc=2E312F"></iframe>'
            );
    }
    else{
        console.log(
            "There is no #bigmap div in this page"
        )
    }
})