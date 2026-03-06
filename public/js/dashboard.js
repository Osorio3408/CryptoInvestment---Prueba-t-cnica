let chart;

async function loadCryptos() {
    
    const table = document.querySelector("#cryptoTable");

    table.innerHTML = `
        <tr>
        <td colspan="4" class="text-center py-4">
        Loading cryptocurrencies...
        </td>
        </tr>
    `;

    const response = await fetch("/api/cryptos");
    const data = await response.json();

    table.innerHTML = "";
    data.data.forEach((crypto) => {
        const row = document.createElement("tr");

        const price = crypto.price ?? 0;
        const change = crypto.percent_change_24h ?? 0;

        row.innerHTML = `
        <td>${crypto.name}</td>
        <td>${crypto.symbol}</td>
        <td>${Number(price).toFixed(2)}</td>
        <td>${Number(change).toFixed(2)}%</td>
    `;

        row.onclick = () => loadHistory(crypto.symbol);

        table.appendChild(row);
    });
}

async function loadHistory(symbol) {
    const response = await fetch(`/api/cryptos/${symbol}/history`);
    const history = await response.json();

    const labels = history.map((h) => h.timestamp);
    const prices = history.map((h) => h.price);

    const ctx = document.getElementById("chart");

    if (chart) {
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: symbol,
                    data: prices,
                    borderColor: "#38bdf8",
                    tension: 0.4,
                },
            ],
        },
        options: {
            responsive: true,
            animation: {
                duration: 800,
            },
            plugins: {
                tooltip: {
                    mode: "index",
                    intersect: false,
                },
                legend: {
                    labels: {
                        color: "white",
                    },
                },
            },
            scales: {
                x: {
                    ticks: { color: "white" },
                },
                y: {
                    ticks: { color: "white" },
                },
            },
        },
    });
}

loadCryptos();
setInterval(loadCryptos, 30000);
