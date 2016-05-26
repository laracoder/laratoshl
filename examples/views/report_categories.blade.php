<html>
<head>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }
        h1,h2,h3,h4 {font-weight: 300;}
        h1 {font-size: 14pt;}
        h2 {font-size: 12pt; }
        h3   { font-size: 10pt;}
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
    <title>Report - Kategorien - {{$month}} {{$year}}</title>
</head>
<body>
<h1>Report - Kategorien - {{$month}} {{$year}}</h1>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
    <tr>
        <td width="10%">Typ</td>
        <td width="50%">Kategorie</td>
        <td width="15%">Anzahl Buchungen</td>
        <td width="25%">Summe</td>
    </tr>
    </thead>
    <tbody>
    @foreach($content->sortBy(['type'])->all() as $category)
        @if($category->type != 'system')
            <tr>
                <td>{{$category->name}}</td>
                @if($category->type == 'income')
                    <td>Einnahme</td>
                    <td>{{$category->incomes->get('count')}}</td>
                    <td>{{$category->incomes->get('sum')}} €</td>
                @elseif($category->type == 'expense')
                    <td>Ausgabe</td>
                    <td>{{$category->expenses->get('count')}}</td>
                    <td>{{$category->expenses->get('sum')}} €</td>
                @endif
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</body>
</html>
