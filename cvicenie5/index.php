<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Cvičenie 5</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.14/dist/jBox.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.14/dist/jBox.all.min.css" rel="stylesheet">
    <script src="js/js.js"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="icon" href="images/icon.png">

</head>
<body class="container">
<header>
    <span class="welcome-header">Webová stránka</span>
</header>
<div class="container border">
    <main>
        <div class="row">
            <div class="text-center">
                <form id="graph">
                    <label class="text-center" style="font-size: 25px" for="parameter">Parametre: </label>
                    <input id="parameter" class="text-center" style="width: 100px; height: 50px; font-size: 40px" type="number">
                    <input type="checkbox" id="sinus" name="sinus">
                    <label class="checkboxLabel" for="sinus">Sínus</label>
                    <input  type="checkbox" id="cosinus" name="cosinus">
                    <label class="checkboxLabel" for="cosinus">Cosínus</label>
                    <input type="checkbox" id="sinuscosinus" name="sinuscosinus">
                    <label class="checkboxLabel" for="sinuscosinus">SínusCosínus</label>
                </form>
                <div class="chartContainer" id="chartContainer" ></div>
            </div>
        <div id="result"></div>
            <script>
                var source = new EventSource("sse.php");
                source.addEventListener("evt",(e)=>{
                    var data = JSON.parse(e.data);
                    document.querySelector("#result").innerHTML = "a: "+data.a+"<br>";
                    document.querySelector("#result").innerHTML += "y1(sin)^2: "+data.y1+"<br>";
                    document.querySelector("#result").innerHTML += "y2(cos)^2: "+data.y2+"<br>";
                    document.querySelector("#result").innerHTML += "y3(sin*cos): "+data.y3;

                    setData(data);
                });
            </script>
        </div>
    </main>

</div>

<footer class="footer">
    ©PeterRigoDevelopment
</footer>
<div id="loading" class="center-screen"><img class="loading-img" alt="ha"  src="images/loading.gif"></div>
<div id="overlay" class="overlay"></div>

</body>

</html>
