document.addEventListener('DOMContentLoaded', function () {
    var data = window.data;

    console.log(data);
    const labels = [];
    const values = [];
    
    for (const element of data) {
        labels.push(element[0]);
        const numericValue = typeof element[1] === 'string'
            ? parseFloat(element[1].replace(',', '.'))
            : element[1];
        
        values.push(numericValue);
    };
    console.log(values);

    const graphData = {
        labels: labels,
        datasets: [{
            label: 'Valor',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: values,
        }]
    };

    const config = {
        type: 'line',
        data: graphData,
        options: {
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        const value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        return 'Valor: ' + value.toFixed(2);
                    }
                }
            }
        }
    };

    new Chart(
        document.getElementById('myChart'),
        config
    );
});
