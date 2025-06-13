<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax XML</title>
    <script>
        var req;

        function ajaxStart() {
            var load = document.getElementById('load');
            load.innerHTML = 'Carregando...';

            var url = "luciano.xml";

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

                    var buffer = "";
                    buffer += "<table border='1' cellpadding='5' cellspacing='0'>";
                    buffer += "<tr><th>Curso</th><th>Código</th><th>Intrutor</th><th>Tipo</th></tr>";

                    var xmlDoc = req.responseXML;
                    var eLuciano = xmlDoc.getElementsByTagName('LANDRE')[0];
                    var eCourses = eLuciano.getElementsByTagName('COURSE');
                    for (var i = 0; i < eCourses.length; i++) {
                        buffer += "<tr>";
                        buffer += "<td>" + eCourses[i]
                            .getElementsByTagName('TITLE')[0]
                            .firstChild
                            .nodeValue + "</td>";
                        buffer += "<td>" + eCourses[i]
                            .getElementsByTagName('TITLE')[0]
                            .getAttribute("id") + "</td>";
                        buffer += "<td>" + eCourses[i]
                            .getElementsByTagName('INSTRUCTOR')[0]
                            .firstChild
                            .nodeValue + "</td>";
                        buffer += "<td>" + eCourses[i]
                            .getElementsByTagName('TYPE')[0]
                            .firstChild
                            .nodeValue + "</td>";
                        buffer += "</tr>";
                    }
                    buffer += "</table>";
                    document.getElementById('meuDiv').innerHTML = buffer;
                } else {
                    alert(req.status + ":  Possível erro.");
                }
            }
        }
    </script>
</head>

<body>
    <h1>Exemplo de captura de XML via AJAX</h1>
    <input type="button" onclick="ajaxStart()" value="Enviar">
    <br><br>
    <div id="meuDiv"></div>
    <div id="load"></div>
</body>

</html>