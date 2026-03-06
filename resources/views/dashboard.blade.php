<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>Crypto Dashboard</title>

</head>

<body class="bg-slate-900 text-white p-10">

<h1 class="text-3xl font-bold mb-8">
CryptoInvestment Dashboard
</h1>

<div class="grid grid-cols-2 gap-10">

<div>

<table class="w-full text-left">

<thead class="border-b border-slate-700 text-slate-400">
<tr>
<th class="py-2">Name</th>
<th>Symbol</th>
<th>Price</th>
<th>24h</th>
</tr>
</thead>

<tbody id="cryptoTable" class="text-sm"></tbody>

</table>

</div>

<div class="bg-slate-800 p-6 rounded-xl">

<canvas id="chart"></canvas>

</div>

</div>

<script src="/js/dashboard.js"></script>

</body>
</html>