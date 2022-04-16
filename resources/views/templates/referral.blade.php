
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
    <table width="100%" style="border-spacing: 0;">
        <thead>
        <tr>
            <th style="border:1px solid #000; text-align: center;padding: 4px;"  colspan="6">Referring Facility Information</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Facility Name: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">DIT Dispensary</td>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Facility Level: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">Dispensary</td>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Referral Type: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{{$data->referral_type}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Referring Doctor: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Attendant::find($data->visit->attendant_id))->full_name}}</td>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Referring Doctor Email: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Attendant::find($data->visit->attendant_id))->email}}</td>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Referring Doctor Phone: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Attendant::find($data->visit->attendant_id))->phone}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Referred Hospital: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{!! $data->hospital_name !!}</td>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Reason for Referral: </td>
            <td colspan="3" style="border:1px solid #000; text-align: center;padding: 4px;">{!! $data->reason_for_referral !!}</td>
        </tr>
        </tbody>
    </table>
    <br/>
    <table width="100%" style="border-spacing: 0;">
        <tr>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">On Going Examination: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{!! $data->patient_examination !!}</td>
            <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">On Going Treatment: </td>
            <td style="border:1px solid #000; text-align: center;padding: 4px;">{!! $data->treatment_given !!}</td>
        </tr>
    </table>
    <br/>
    <table width="100%" style="border-spacing: 0;"> <thead>
        <tr>
            <th style="border:1px solid #000; text-align: center;padding: 4px;"  colspan="4">Diagnoses Information</th>
        </tr>
        </thead>
        <tbody>
        @foreach((\App\Models\PatientVisit::find($data->patient_visit_id))->diagnoses as $diagnosis)
            <tr>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;"> Diagnosis Name: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $diagnosis->i_c_d10_code->code }}</td>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Diagnosis Type: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $diagnosis->type }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    <table width="100%" style="border-spacing: 0;">
        <thead>
        <tr>
            <th style="border:1px solid #000; text-align: center;padding: 4px;"  colspan="4">Investigations Information</th>
        </tr>
        </thead>
        <tbody>
        @foreach((\App\Models\PatientVisit::find($data->patient_visit_id))->investigations as $investigation)
            <tr>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;"> Investigation Name: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $investigation->laboratory_test->name }}</td>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Investigation Result: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{!! $investigation->result !!}</td>
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
