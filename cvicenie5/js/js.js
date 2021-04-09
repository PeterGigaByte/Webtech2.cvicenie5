let sinus=[];
let cosinus=[];
let sinusCosinus=[];
let x = 0;
function setData(data){
    sinus.push({
        x:x,
        y:data.y1
    });
    cosinus.push({
        x:x,
        y:data.y2
    });
    sinusCosinus.push({
        x:x,
        y:data.y3
    });
    x++;
}
$(document).ready(function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        title :{
            text: "Dynamic Data"
        },
        data: [{
            type: "line",
            showInLegend: true,
            name: "Sínus",
            legendText: "Sínus",
            dataPoints: sinus
        },
        {
            type: "line",
            showInLegend: true,
            name: "Cosinus",
            legendText: "Cosinus",
            dataPoints: cosinus
        },
        {
            type: "line",
            showInLegend: true,
            name: "SinusCosinus",
            legendText: "SinusCosinus",
            dataPoints: sinusCosinus
        }]

    });

    var updateInterval = 1000;
    var dataLength = 20; // number of dataPoints visible at any point

    var updateChart = function (count) {
        if (sinus.length > dataLength) {
            sinus.shift();
            cosinus.shift();
            sinusCosinus.shift();
        }

        chart.render();
    };

    updateChart(dataLength);
    setInterval(function(){updateChart()}, updateInterval);
    let parameter = $("#parameter");
    let sinusC = $("#sinus");
    let cosinusC = $("#cosinus");
    let sinusCosinusC = $("#sinuscosinus");
    $.ajax({
        type : "GET",
        url : "dataOnLoad.php",
        async: false,
        dataType: "json",
        success: function (result){
            if(result==""){
                parameter.val(1);
                sinusC.prop( "checked", true )
                cosinusC.prop( "checked", true )
                sinusCosinusC.prop( "checked", true )
            }else{
                result = result[0];
                parameter.val(result["constant"]);
                var bool_sinus = result["sinus"] === "true";
                var bool_cosinus = result["cosinus"] === "true";
                var bool_sinus_cosinus = result["sinus_cosinus"] === "true";
                sinusC.prop( "checked", bool_sinus );
                cosinusC.prop( "checked", bool_cosinus );
                sinusCosinusC.prop( "checked", bool_sinus_cosinus );
            }
        },
        error : function(e) {
            new jBox('Notice', {
                animation: 'flip',
                color: 'red',
                content: 'Nastala chyba !',
                delayOnHover: true,
                showCountdown: true
            });
            console.log(e)
        }
    });
    sinusC.change(function (){
        ajaxPost();
    });
    cosinusC.change(function (){
        ajaxPost();
    });
    sinusCosinusC.change(function (){
        ajaxPost();
    });
    parameter.change(function (){
        ajaxPost()
    });
    function ajaxPost(){
        $.ajax({
            type : "POST",
            url : "data.php",
            async: false,
            data: {parameter_value:parameter.val(),
                sinus_value:sinusC.is(':checked'),
                cosinus_value:cosinusC.is(':checked'),
                sinus_cosinus_value:sinusCosinusC.is(':checked')},

            success: function (result){
                console.log(result);
                console.log("success");
            },
            error : function(e) {
                new jBox('Notice', {
                    animation: 'flip',
                    color: 'red',
                    content: 'Nastala chyba !',
                    delayOnHover: true,
                    showCountdown: true
                });
                console.log(e)
            }
        });
    }


});
