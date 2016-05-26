<html>
<head>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }
        h1,h2,h3,h4 {font-weight: 300;}
        h1 {font-size: 16pt;}
        h2 {font-size: 14pt; }
        h3   { font-size: 12pt;}
        table.items { border: 0.1mm solid #000000;}
        td { vertical-align: top; }
        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }
        table thead td {
            background-color: #EEEEEE;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }
    </style>
    <title>Finanz-Report {{$month}} {{$year}}</title>
</head>
<body>
<table  width="100%"  cellpadding="0">
    <tr>
        <td width="60%"><h1>Finanz-Report</h1></td>
        <td width="40%" align="right"><h1>{{$month}} {{$year}}</h1></td>
    </tr>
</table>
<h2>Einnahmen/Ausgaben je Kategorie</h2>
<h3>Einnahmen</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
    <tr>
        <td width="60%">Kategorie</td>
        <td width="15%">Anzahl Buchungen</td>
        <td width="25%" align="right">Summe</td>
    </tr>
    </thead>
    <tbody>
    @foreach($income->all() as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->incomes->get('count')}}</td>
            <td align="right">{{$category->incomes->get('sum')}} €</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h3>Ausgaben</h3>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
    <tr>
        <td width="60%">Kategorie</td>
        <td width="15%">Anzahl Buchungen</td>
        <td width="25%" align="right">Summe</td>
    </tr>
    </thead>
    <tbody>
    @foreach($expense->all() as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->expenses->get('count')}}</td>
            <td align="right">{{$category->expenses->get('sum')}} €</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
