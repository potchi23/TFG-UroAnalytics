const BACKEND_URL = "http://localhost:5000";

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

    $('#prediction-button').click(() => {
        let features = [];
        $(".prediction-form-input").each((index, value) => {
            if($(value).attr('id') != "FECHACIR" && $(value).attr('id') != "FECHAFIN" && $(value).attr('id') != "ETNIA" && $(value).attr('id') != "HISTO2" && $(value).attr('id') != "Unnamed: 51" && $(value).attr('id') != "Unnamed: 52" && $(value).attr('id') != "NHIS" && $(value).attr('id') != "NOTAS" && $(value).attr('id') != "Unnamed: 60" && $(value).attr('id') != "Unnamed: 61" && $(value).attr('id') != "RBQ"){
                features.push($(value).attr('value') == "" ? 0 : $(value).attr('value'));
            }
        });
        
        let data = {
            'features': features.toString(),
            'algorithm' : $('#algorithms').val()
        }
        $.ajax({
            type: 'POST',
            url: BACKEND_URL + "/predict",
            data : data,

            success : result => {
                $("#prediciton-result").val(result);
            },
            error : e => {
                console.log('Request failed: ' + e);
            }
        });
    });
});