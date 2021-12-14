/*
    IGNORAD ESTE JAVASCRIPT!!!!!!!!

    Este código ya se utiliza para nada, pero puede 
    servir de referencia en el futuro.
*/

function sendEmail(email, message) {
	Email.send({
	    Host: "smtp.gmail.com",
	    Username : "ucmtfg1234@gmail.com",
	    Password : "Tfgucm1234",
	    To : email,
	    From : "ucmtfg1234@gmail.com",
	    Subject : "Estado de solicitud de registro",
	    Body : message
	}); 
}

function accept_register_petition(id){
    let data = {
        "id":id
    }

    $.ajax({
        type: "PATCH",
        url: "http://localhost:5000/register_petitions",
        data: data,
       
        success: response => {
            response = response.replaceAll("\'", "\"");
            let user_data = JSON.parse(response)["data"][0];

            $(`#register_petition_${id}`).remove();

            message = `Hola ${user_data["name"]}. Te informamos que hemos aceptado tu solicitud de registro.`;
            sendEmail(user_data["email"], message);
        },

        error: e => {
            if(console && console.log) {
                console.log("Request failed: " +  e);
            }
        }
    });
}

function reject_register_petition(id){
    let data = {
        "id":id
    }

    $.ajax({
        type: "DELETE",
        url: "http://localhost:5000/register_petitions",
        data: data,
       
        success: response => {
            response = response.replaceAll("\'", "\"");
            let user_data = JSON.parse(response)["data"][0];

            $(`#register_petition_${id}`).remove();

            message = `Hola ${user_data["name"]}. Te informamos que hemos rechazado tu solicitud de registro.`;
            sendEmail(user_data["email"], message);
        },

        error: e => {
            if(console && console.log) {
                console.log("Request failed: " +  e);
            }
        }
    });
}

function print_register_petitions(){
    $.ajax({
        type: "GET",
        url: "http://localhost:5000/register_petitions",
       
        success: response =>{
            response = response.replaceAll("\'", "\"");
            let register_requests = JSON.parse(response)["data"];
            
            if(register_requests.length > 0){
                $("#register_petitions").append(`
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                        <th>Email</th>
                        <th>Aceptar</th>
                    </tr>
                `);
                register_requests.forEach(register_request => {
                    user_id = register_request["id"];
                    $("#register_petitions").append(`
                        <tr id="register_petition_${user_id}">
                           <td> ${user_id} </td>
                           <td> ${register_request["name"]} </td>
                           <td> ${register_request["surname_1"]} </td>
                           <td> ${register_request["surname_2"]} </td>
                           <td> ${register_request["email"]} </td>
                           <td>
                                <button onClick="accept_register_petition(${user_id})">✔</button>
                                <button onClick="reject_register_petition(${user_id})">✘</button>
                           </td>
                        </tr>
                    `);
                });
            }
            else{
                $("#register_petitions").append(`<h2>No hay solicitudes de registro</h2>`);
            }
        },

        error: e =>{
            if(console && console.log) {
                console.log("Request failed: " +  e);
            }
        }
    });
}

$(document).ready(() => {
    print_register_petitions();
});