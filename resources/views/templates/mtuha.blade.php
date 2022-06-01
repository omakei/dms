@extends('templates.layout')
@section('content')
    @include('templates.mtuha_header', ['from' => $data['from'], 'to' => $data['to']])
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-y6fn{background-color:#c0c0c0;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<table class="tg">
    <thead>
    <tr>
        <th class="tg-y6fn" rowspan="2">Na<br></th>
        <th class="tg-y6fn" rowspan="2">Maelezo</th>
        <th class="tg-y6fn" colspan="3">Umri chini ya  mwezi 1</th>
        <th class="tg-y6fn" colspan="3">Umri mwezi 1 hadi umri chini ya mwaka 1</th>
        <th class="tg-y6fn" colspan="3">Umri mwaka 1 hadi chini ya miaka 5</th>
        <th class="tg-y6fn" colspan="3">Miaka 5 hadi chini ya miaka 60</th>
        <th class="tg-y6fn" colspan="3">Umri wa miaka 60 na kuendelea</th>
        <th class="tg-y6fn" colspan="3">Jumla kuu</th>
    </tr>
    <tr>
        <th class="tg-y6fn">me</th>
        <th class="tg-y6fn">ke</th>
        <th class="tg-y6fn">jumla</th>
        <th class="tg-y6fn">me</th>
        <th class="tg-y6fn">ke</th>
        <th class="tg-y6fn">jumla</th>
        <th class="tg-y6fn">me</th>
        <th class="tg-y6fn">ke</th>
        <th class="tg-y6fn">jumla</th>
        <th class="tg-y6fn">me</th>
        <th class="tg-y6fn">ke</th>
        <th class="tg-y6fn">jumla</th>
        <th class="tg-y6fn">me</th>
        <th class="tg-y6fn">ke</th>
        <th class="tg-y6fn">jumla</th>
        <th class="tg-y6fn">me</th>
        <th class="tg-y6fn">ke</th>
        <th class="tg-y6fn">Jumla</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="tg-0lax">1</td>
        <td class="tg-0lax">Mahudhurio ya OPD</td>
        <td class="tg-0lax">{{ $data['one_month']['me'] }}</td>
        <td class="tg-0lax">{{ $data['one_month']['ke'] }}</td>
        <td class="tg-0lax">{{ $data['one_month']['total'] }}</td>
        <td class="tg-0lax">{{ $data['one_year']['me'] }}</td>
        <td class="tg-0lax">{{ $data['one_year']['ke'] }}</td>
        <td class="tg-0lax">{{ $data['one_year']['total'] }}</td>
        <td class="tg-0lax">{{ $data['five_year']['me'] }}</td>
        <td class="tg-0lax">{{ $data['five_year']['ke'] }}</td>
        <td class="tg-0lax">{{ $data['five_year']['total'] }}</td>
        <td class="tg-0lax">{{ $data['sixty_year']['me'] }}</td>
        <td class="tg-0lax">{{ $data['sixty_year']['ke'] }}</td>
        <td class="tg-0lax">{{ $data['sixty_year']['total'] }}</td>
        <td class="tg-0lax">{{ $data['above_sixty_year']['me'] }}</td>
        <td class="tg-0lax">{{ $data['above_sixty_year']['ke'] }}</td>
        <td class="tg-0lax">{{ $data['above_sixty_year']['total'] }}</td>
        <td class="tg-0lax">{{ $data['total']['me'] }}</td>
        <td class="tg-0lax">{{ $data['total']['ke'] }}</td>
        <td class="tg-0lax">{{ $data['total']['total'] }}</td>
    </tr>
    <tr>
        <td class="tg-0lax">2<br></td>
        <td class="tg-0lax">wagonjwa walio hudhuria kwa mara ya kwanza mwaka huu*</td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
    </tr>
    <tr>
        <td class="tg-0lax">3</td>
        <td class="tg-0lax">Mahudhurio ya marudio</td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
    </tr>
    <tr>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn">Diagnoses za OPD</td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
        <td class="tg-y6fn"></td>
    </tr>
    <tr>
        <td class="tg-0lax">1<br></td>
        <td class="tg-0lax">cholera</td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
        <td class="tg-0lax"></td>
    </tr>
    </tbody>
</table>
@endsection
