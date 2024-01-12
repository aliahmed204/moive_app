<div id="movie-chart"></div>
<script src="{{asset('dashboard')}}/js/jquery-3.7.0.min.js"></script>

<script>
    $(function(){
        var options = {
            chart: {
                type: 'bar',
                height: 350,
            },
            colors: ['#009688'],
            series: [{
                name: 'total movies',
                data: @json($chart->pluck('total_movies')->toArray())
            }],
            xaxis: {
                categories: @json($chart->pluck('month')->toArray())
            },
        }

        var chart = new ApexCharts(document.querySelector("#movie-chart"), options);

        chart.render();
    });
</script>
