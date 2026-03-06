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
        const changeColor = change >= 0 ? "text-green-400" : "text-red-400";

        row.innerHTML = `
        <td>${crypto.id}</td>
        <td>${crypto.name}</td>
        <td>${crypto.symbol}</td>
        <td>${Number(price).toFixed(2)}</td>
        <td class="${changeColor}">${Number(change).toFixed(2)}%</td>
    `;

        row.onclick = () => loadHistory(crypto.id);

        table.appendChild(row);
    });
}

async function loadHistory(id) {
    const response = await fetch(`/api/cryptos/${id}/history`);
    const history = await response.json();

    if (!history.length) {
        console.warn("No history data yet");
        return;
    }

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
                    label: id,
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
