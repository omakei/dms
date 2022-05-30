
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
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ (\App\Models\Patient::find($data->patient_id))->full_name}}</td>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Gender: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Patient::find($data->patient_id))->gender}}</td>
                <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">Patient Number: </td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">{{(\App\Models\Patient::find($data->patient_id))->patient_number}}</td>
            </tr>
            </tbody>
        </table>
        <br/>
        <table width="100%" style="border-spacing: 0;"> <thead>
            <tr>
                <th style="border:1px solid #000; text-align: center;padding: 4px;"  colspan="3">Billable Information</th>
            </tr>
            <tr>
                <th style="border:1px solid #000; text-align: center;padding: 4px;">Name</th>
                <th style="border:1px solid #000; text-align: center;padding: 4px;">Type</th>
                <th style="border:1px solid #000; text-align: center;padding: 4px;">Amount</th>
            </tr>
            </thead>
            <tbody>
            @foreach((\App\Models\Bill::find($bill->id))->bill_items as $item)
                <tr>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ $item->billable->name }}</td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ str_replace('App\Models\\','',$item->billable_type) }}</td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;">{{ number_format($item->billable->price, 2) }} TZS</td>
                </tr>
            @endforeach
                <tr>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;" colspan="2">Total</td>
                    <td style="border:1px solid #000; text-align: center;padding: 4px;" colspan="3">{{ number_format((\App\Models\Bill::find($bill->id))
                            ->bill_items->sum(function ($item) {
                                return $item->billable->price;
                            }), 2) }} TZS</td>
                </tr>
            </tbody>
        </table>
        <br/>
        <div>
            <h5> QR Code: </h5>
            <div><img src="data:image/svg+xml;base64,{{base64_encode($qrcode)}}"  width="120" height="120" /></div>
        </div>
    </div>
@endsection
