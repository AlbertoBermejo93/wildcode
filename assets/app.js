/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

    // location.reload();

$('#addArgonaute').on('click', function(e){
    e.preventDefault();
 

    if($('#nom').val().length === 0 ){
        alert('Please enter value')
    }else{

        $('#addArgonaute').attr('disabled', 'disabled');

        $.ajax({
            method: "POST",
            url: '/equipage/ajax',
            dataType: 'json',
            async: true,
            data : {
            'nom' : $('#nom').val(),
                },dataType: "text",
                success: function(msg){
                    var result = JSON.parse(msg);
                    console.log (result);
                },
                error: function(request){
                    var result = JSON.parse(msg);
                    console.log (result);
                    alert(request.responseText);
                }
    
        }) 
        location.reload();
    }
})
