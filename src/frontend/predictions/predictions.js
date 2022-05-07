const BACKEND_URL = 'http://localhost:5000';

$(document).ready(() => {
    if($('#algorithms').val() != 'none'){
        $('#prediction-button').show();
    }
    else{
        $('#prediction-button').hide();
    }

    $('#last-train').ready(() => {
        $.ajax({
            type: 'GET',
            url: BACKEND_URL + '/training/lastTraining',
            beforeSend: (request) => {
                request.setRequestHeader("x-access-token", $('#token').val());
            },
            success : result => {
                $('#last-train-date').text(result);
            },
            error : e => {
                console.log('Request failed: ' +  e);
            }   
        });        
    });

    $('#algorithms').change(() => {
        $.ajax({
            type: 'GET',
            url: BACKEND_URL + '/training/scores',
            beforeSend: (request) => {
                request.setRequestHeader("x-access-token", $('#token').val());
            },
            success : result => {
                let scores = result;

                if($('#algorithms').val() != 'none'){
                    $('#prediction-button').show();
                    $('#prediction-button-existent').show();

                    $('#prediction-accuracy').val((parseFloat(scores[$('#algorithms').val()]['accuracy'])*100).toFixed(2) + '%');

                    $('#prediction-recall-1').val((parseFloat(scores[$('#algorithms').val()]['recall'][0])*100).toFixed(2) + '%');
                    $('#prediction-recall-2').val((parseFloat(scores[$('#algorithms').val()]['recall'][1])*100).toFixed(2) + '%');


                    $('#prediction-precision-1').val((parseFloat(scores[$('#algorithms').val()]['precision'][0])*100).toFixed(2) + '%');
                    $('#prediction-precision-2').val((parseFloat(scores[$('#algorithms').val()]['precision'][1])*100).toFixed(2) + '%');
                }
                else{
                    $('#prediction-button').hide();
                    $('#prediction-button-existent').hide();

                    $('#prediction-accuracy').val('0.0%');

                    $('#prediction-accuracy').val(0.0 + '%');

                    $('#prediction-recall-1').val(0.0 + '%');
                    $('#prediction-recall-2').val(0.0 + '%');

                    $('#prediction-precision-1').val(0.0 + '%');
                    $('#prediction-precision-2').val(0.0 + '%');

                    $('.prediction-result').val('');
                }
            },

            statusCode:{
                401: () => { 
                    alert('La sesión ha caducado. Vuelva a iniciar sesión.');
                    window.location.href = '../login.php';
                }
            },
            
            error : e => {
                console.log('Request failed: ' +  e);
            }
        });
        
    });

    $('#prediction-button').click(() => {
        let features = [];
        let hasEmptyValues = false;

        $('.prediction-form-input').each((index, row) => {
            if(rowUsedForTraining(row)){
                let value = document.getElementById(row.id).value;
                if(!value || isNaN(parseFloat(value))){
                    $("#" + row.id + ".prediction-form-input").css("border-color","red");
                    hasEmptyValues = true;
                }
                else{
                    $("#" + row.id + ".prediction-form-input").css("border-color","lightgray");
                }

                features.push(value == "" || value == undefined ? undefined : parseFloat(value));
            }
        });

        if(hasEmptyValues){
            document.getElementById('dataPatients').scrollIntoView();
            $('.alert-message').remove();
            alert("Error en el formulario. Por favor, revise y rellene todos los campos requeridos correctamente");
        }
        else{
            predict(features);
        }
    });
});

function select(event){
    let id = event.id 

    $('#selected').val(id);
    $('.modal-title').text('Predecir sobre el paciente #' + id);
    $('.prediction-result').val('');
    $('.prediction-result-input').val('');
}

function rowUsedForTraining(row){
    let ignored_columns = ['N', 'NOTAS', 'FECHACIR', 'FECHAFIN','ETNIA', 'IPERIN', 'ILINF', 'IVASCU', 'ILINF2', 'IVASCU2', 'FALLEC', 'RBQ'];

    return !ignored_columns.includes($(row).attr('id')) ;
}

function predict(features){
    let data = {
        'features': features.toString(),
        'algorithm' : $('#algorithms').val()
    }
    $.ajax({
        type: 'POST',
        url: BACKEND_URL + '/predict',
        data : data,
        beforeSend: (request) => {
            request.setRequestHeader("x-access-token", $('#token').val());
        },

        success : result => {
            $('.prediction-result').val(result);
        },
        error : e => {
            console.log('Request failed: ' + e);
        }
    });
}