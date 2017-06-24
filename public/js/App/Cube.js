/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var page = {
    init: function ()
    {
        $("#btnEjecutar").click(page.ejecutar);
        $('#txtQuey').focus();
        $('#txtQuey').on('keypress', function (e) {
            if (e.which === 13) {

                //Disable textbox to prevent multiple submit
                page.ejecutar();
            }
        });

    }
    , ejecutar: function ()
    {
        $.ajax({
            url: "/ValidateQuery",
            type: "POST",
            dataType: "json",
            data: {
                queryText: $('#txtQuey').val()
                ,_token: $('input[name=_token]').val()

            },
            success: function (data) {

                alert(data.historia);
            }
            , error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error");
            }
        });


    }
};