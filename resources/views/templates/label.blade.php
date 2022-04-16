
@extends('templates.layout')
@section('content')
    <div>
        <div class="page">
            <table class="tg" style="font-size: 5pt;" >
                <thead>
                <tr>
                    <th class="tg-0pky">Field</th>
                    <th class="tg-0pky">Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="tg-0pky">Patient Name: </td>
                    <td class="tg-0pky">{{ (\App\Models\Patient::find($data->visit->patient_id))->full_name}}</td>
                </tr>
                <tr>
                    <td class="tg-0pky">Gender: </td>
                    <td class="tg-0pky">{{(\App\Models\Patient::find($data->visit->patient_id))->gender}}</td>
                </tr>
                <tr>
                    <td class="tg-0pky">Patient Number: </td>
                    <td class="tg-0pky">{{(\App\Models\Patient::find($data->visit->patient_id))->patient_number}}</td>
                </tr>
                <tr>
                    <td class="tg-0pky">Test Name: </td>
                    <td class="tg-0pky">{{$data->laboratory_test->name}}</td>
                </tr>
                <tr>
                    <td class="tg-0pky">Code: </td>
                    <td class="tg-0pky"><img src="data:image/svg+xml;base64,{{base64_encode($qrcode)}}"  width="40" height="40" /></td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

@endsection
