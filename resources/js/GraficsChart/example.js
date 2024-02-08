import Chart from 'chart.js/auto';

const data = [{x: 'Jan', net: 1400, cogs: 500, gm: 600}];
const cfg = {
    type: 'bar',
    data: {
        labels: ['Jan'],
        datasets: [{
            label: 'Ingresos',
            data: data,
            parsing: {
                yAxisKey: 'net'
            }
        }, {
            label: 'Gastos',
            data: data,
            parsing: {
                yAxisKey: 'cogs'
            }
        }, {
            label: 'Presupuesto',
            data: data,
            parsing: {
                yAxisKey: 'gm'
            }
        }]
    },
};

new Chart(document.getElementById('myChart'), cfg);
