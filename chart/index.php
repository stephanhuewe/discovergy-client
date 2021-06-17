<!DOCTYPE html>
<html>
<head>
<title>PV Statistics</title>
<style type="text/css">
BODY {
    width: 1550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>


</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("getChartData.php",
                function (data)
                {
                    var times = [];
                    var power = [];

		    var jsonData = JSON.parse(data);
                    for (var i = 0; i < jsonData.powerdata.length; i++) {
                    var counter = jsonData.powerdata[i];
      
                    times.push(new Date(counter.time).toLocaleString());
                    power.push(counter.values.power / 1000);
                   }
                    

                    var chartdata = {
                        labels: times,
                        datasets: [
                            {
                                label: 'Statistics PV (- Sell / + Buy)',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: power
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>

</body>
</html>