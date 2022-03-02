$(document).ready(() => {
    $('#algorithms').change(() => {
        $.ajax({
            type: 'GET',
            url: 'getScores.php',
    
            success : result => {
                let scores = JSON.parse(result);

                if($('#algorithms').val() != 'default'){
                    $('#prediciton-accuracy').val(parseFloat(scores[$('#algorithms').val()]['accuracy']).toFixed(4) + "%");

                    $('#prediciton-recall-1').val(parseFloat(scores[$('#algorithms').val()]['recall'][0]).toFixed(4) + "%");
                    $('#prediciton-recall-2').val(parseFloat(scores[$('#algorithms').val()]['recall'][1]).toFixed(4) + "%");
                    $('#prediciton-recall-3').val(parseFloat(scores[$('#algorithms').val()]['recall'][2]).toFixed(4) + "%");

                    $('#prediciton-precision-1').val(parseFloat(scores[$('#algorithms').val()]['precision'][0]).toFixed(4) + "%");
                    $('#prediciton-precision-2').val(parseFloat(scores[$('#algorithms').val()]['precision'][1]).toFixed(4) + "%");
                    $('#prediciton-precision-3').val(parseFloat(scores[$('#algorithms').val()]['precision'][2]).toFixed(4) + "%");

                }
                else{
                    $('#prediciton-accuracy').val('0.0%');

                    $('#prediciton-accuracy').val(0.0 + "%");

                    $('#prediciton-recall-1').val(0.0 + "%");
                    $('#prediciton-recall-2').val(0.0 + "%");
                    $('#prediciton-recall-3').val(0.0 + "%");

                    $('#prediciton-precision-1').val(0.0 + "%");
                    $('#prediciton-precision-2').val(0.0 + "%");
                    $('#prediciton-precision-3').val(0.0 + "%");
                }
            },
            error : e => {
                console.log('Request failed: ' +  e);
            }
        });
        
    });
});