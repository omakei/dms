<table width="100%">
    <tr>
        <td rowspan="5"><img src="{{ public_path('coat-of-arms.png') }}" alt="Logo" width="120" height="120"></td>
        <td style="text-align: center;padding: 4px;">THE UNITED REPUBLIC OF TANZANIA</td>
        <td rowspan="5"><img src="{{ public_path('logo-dit.png') }}" alt="Logo" width="120" height="120"></td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 4px;">MINISTRY OF HEALTH AND SOCIAL WELFARE</td>

    </tr>
    <tr>
        <td style="text-align: center;padding: 4px;">MFUMO WA TAARIFA ZA UENDESHAJI WA HUDUMA ZA AFYA</td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 4px;">MTUHA TOLEO LA MWAKA {{ now()->year }}</td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 4px;">FOMU YA TAARIFA YA KITABU CHA 5: REJESTA YA WAGONJWA WA NJE (OPD)</td>
    </tr>

    <tr>
        <td style="text-align: center;padding: 4px;">Jina la Kituo: DIT Dispensary</td>
        <td style="text-align: center;padding: 4px;">Wilaya: Ilala</td>
        <td style="text-align: center;padding: 4px;">Mkoa: Dar es salaam</td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 4px;">Tarehe ya kuanza: {{ $from }}</td>
        <td colspan="2" style="text-align: center;padding: 4px;">Tarehe ya kumaliza: {{ $to }} </td>
    </tr>
</table>

