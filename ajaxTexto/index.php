<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Texto</title>
    <script>
        var req;

        function ajaxStart() {
            var load = document.getElementById('load');
            load.innerHTML = 'Carregando...';

            var url = "luciano.txt";

            if (window.XMLHttpRequest) {
                req = new XMLHttpRequest();
                req.onreadystatechange = ajaxProcessarRecebimento;
                req.open('GET', url);
                req.send(null);
            } else if (window.ActiveXObject) {
                req = new ActiveXObject('Microsoft.XMLHTTP');
                req.onreadystatechange = ajaxProcessarRecebimento;
                req.open('GET', url);
                req.send();
            }
        }

        function ajaxProcessarRecebimento() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    var load = document.getElementById('load');
                    load.innerHTML = '';
                    document.getElementById('meuDiv').innerHTML = req.responseText;
                } else {
                    alert(req.status + ":  Possível erro.");
                }
            }
        }
    </script>
</head>

<body>
    <h1>Exemplo de captura de texto via AJAX</h1>
    <input type="button" onclick="ajaxStart()" value="Enviar">
    <br><br>
    <div id="meuDiv"></div>
    <div id="load"></div>
</body>

</html>