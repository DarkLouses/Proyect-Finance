import Chart from 'chart.js/auto';

const total_incomes_month = window.total_incomes_month;
const total_expenses_month = window.total_expenses_month;

const date = new Date()
const month = date.toLocaleString('default', {month: 'long'})

const data = [{x: month, net: total_incomes_month, cogs: total_expenses_month, gm: 600}];
const cfg = {
    type: 'bar',
    data: {
        labels: [month],
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
        }, ]
    },
};

new Chart(document.getElementById('myChart'), cfg);
