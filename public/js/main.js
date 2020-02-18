var url = 'http://localhost/red_social/public';
window.addEventListener('load', function(){
    
    // Botón de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.png');
            dislike();
            
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Like correcto');
                    }else {
                        console.log('Like incorrecto');
                    }
                }
            });
        });
    }
    like();
    // Botón de dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart-grey.png');
            like();
            
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Dislike correcto');
                    }else {
                        console.log('Dislike incorrecto');
                    }
                }
            });
        });
        
    }
    dislike();
    
    
    // Buscador
    $('#buscador').submit(function(){
        $(this).attr('action',url+'/users/'+$('#buscador #search').val());
    });
});

