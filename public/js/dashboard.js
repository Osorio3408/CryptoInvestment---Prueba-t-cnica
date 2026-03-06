let chart;

async function loadCryptos(){

    const response = await fetch('/api/cryptos');
    const data = await response.json();

    const table = document.querySelector('#cryptoTable tbody');
    table.innerHTML = '';

    data.data.forEach(crypto => {

        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${crypto.name}</td>
            <td>${crypto.symbol}</td>
            <td>${crypto.quote.USD.price.toFixed(2)}</td>
            <td>${crypto.quote.USD.percent_change_24h.toFixed(2)}%</td>
        `;

        row.onclick = () => loadHistory(crypto.symbol);

        table.appendChild(row);
    });
}

async function loadHistory(symbol){

    const response = await fetch(`/api/cryptos/${symbol}/history`);
    const history = await response.json();

    const labels = history.map(h => h.timestamp);
    const prices = history.map(h => h.price);

    const ctx = document.getElementById('chart');

    if(chart){
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: 'line',
        data:{
            labels: labels,
            datasets:[{
                label: symbol,
                data: prices
            }]
        }
    });
}

loadCryptos();
setInterval(loadCryptos,30000);