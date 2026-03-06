<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CryptoInvestment Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body{
            font-family: Arial;
            padding:40px;
            background:#0f172a;
            color:white;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-bottom:40px;
        }

        td,th{
            padding:10px;
            border-bottom:1px solid #334155;
        }

        tr:hover{
            background:#1e293b;
            cursor:pointer;
        }

        canvas{
            max-width:900px;
        }
    </style>
</head>

<body>

<h1>CryptoInvestment Dashboard</h1>

<table id="cryptoTable">
<thead>
<tr>
<th>Name</th>
<th>Symbol</th>
<th>Price</th>
<th>24h Change</th>
</tr>
</thead>

<tbody></tbody>
</table>

<canvas id="chart"></canvas>

<script src="/js/dashboard.js"></script>

</body>
</html>