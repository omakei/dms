
@extends('templates.layout')
@section('content')
    @include('templates.header')
    <div style="font-size: 9pt;" >
        <br/>
        <table width="100%" style="border-spacing: 0;">
            <thead>
            <tr>
                <th style="border:1px solid #000; text-align: center;padding: 4px;"  colspan="6">Patient Information</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Patient Name: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ (\App\Models\Patient::find($data->visit->patient_id))->full_name}}</td>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Gender: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Patient::find($data->visit->patient_id))->gender}}</td>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Patient Number: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Patient::find($data->visit->patient_id))->patient_number}}</td>
            </tr>
            </tbody>
        </table>
        <br/>
        <table width="100%" style="border-spacing: 0;"> <thead>
            <tr>
                <th style="border:1px solid #000; text-align: center;padding: 4px;"  colspan="14">Prescription Information</th>
            </tr>
            </thead>
            <tbody>
            @foreach((\App\Models\PatientVisit::find($data->patient_visit_id))->prescriptions as $prescription)
                <tr>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;"> Medicine Name: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $prescription->medicine->name }}</td>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Dosage: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $prescription->dosage }}</td>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Frequency: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $prescription->frequency }}</td>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Duration: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $prescription->duration }}</td>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Food relation: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $prescription->food_relation }}</td>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Route: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $prescription->route }}</td>
                    <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Instructions: </td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{!! $prescription->instructions  !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <div>
            <h5> QR Code: </h5>
            <div><img src="data:image/svg+xml;base64,{{base64_encode($qrcode)}}"  width="120" height="120" /></div>
        </div>
    </div>
@endsection
