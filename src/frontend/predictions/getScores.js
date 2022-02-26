$(document).ready(() => {
    $('#algorithms').change(() => {
        $.ajax({
            type: 'GET',
            url: 'getScores.php',
    
            success : result => {
                let accuracy = JSON.parse(result);

                if($('#algorithms').val() != 'default'){
                    $('#prediciton-accuracy').val(parseFloat(accuracy[$('#algorithms').val()]).toFixed(2));
                }
                else{
                    $('#prediciton-accuracy').val('0.0');
                }
            },
            error : e => {
                console.log('Request failed: ' +  e);
            }
        });
        
    });
});