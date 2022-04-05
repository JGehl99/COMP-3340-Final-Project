window.onload = () =>{
    chart();

}


async function chart() {
    const data = await getData();
    const ctx = document.getElementById('chart').getContext('2d');
    const chartL = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.x,
            datasets: [{
                label: 'Global and Hemispheric Monthly Means and Zonal Annual Means',
                data: data.y,
                fill: false,
                borderColor: 'grey',
                borderWidth: 1,

            },]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks:{
                        callback: function (value){
                            return value + '°';
                        }
                    }
                }
                ]
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        },
        plugins: {
            legend:{
                display: true,
                labels: {
                    color: 'red'
                }
            }
        },
    });


}

async function getData() {
    const x = [];
    const y = [];

    const response = await fetch('../static/global_temps.csv');
    const data = await response.text();

    const table = data.split('\n').slice(1);
    table.forEach(elm => {
        const col = elm.split(',');
        const year = col[0];
        x.push(year);
        const temp = col[1];
        //Mean readjustment for temps as data is given as variation from mean.
        y.push(parseFloat(temp) + 14);
    });
    return {x, y};
}