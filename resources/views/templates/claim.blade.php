
@extends('templates.layout')
@section('content')
    @include('templates.claim_header')
    <div style="font-size: 9pt;" >
        <br/>
        <table width="100%" style="border-spacing: 0;">
            <tr>
                <td colspan="5" style="font-weight: bold; text-align: left;padding: 4px;">A1. Health Facility</td>
            </tr>
            <tr>
                <td style="padding: 4px;">1) Name of Health Facility: DIT Despensary </td>
                <td style="padding: 4px;">2) Address: Dar es salaam, Upanga</td>
                <td style="padding: 4px;">3) Department: OPD</td>
                <td colspan="2" style="padding: 4px;">4) Date of attendance: {{now()->toDateString()}}</td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight: bold; text-align: left;padding: 4px;">A2. Patient's Particulars</td>
            </tr>
            <tr>
                <td style="padding: 4px;">1) Name of Patient: Michael Omakei</td>
                <td style="padding: 4px;">2) DOB: {{(now()->subYears(25))->toDateString()}}</td>
                <td style="padding: 4px;">3) Sex M/F: M</td>
                <td style="padding: 4px;">4) Occupation: Engineer</td>
                <td style="padding: 4px;">5) Patient's File No: PV-2021-983-234</td>
            </tr>
            <tr>
                <td style="padding: 4px;">6) Patient's Physical Address: Mikocheni</td>
                <td style="padding: 4px;">7) Card No: 987664738833</td>
                <td colspan="2"  style="padding: 4px;">8) Authorization No: 987664738832</td>
            </tr>
            <tr>
                <td style="padding: 4px;">9) Vote No: Mikocheni</td>
                <td style="padding: 4px;">10) Preliminary Diagnosis: A0104, A0105, A0106</td>
                <td colspan="2"  style="padding: 4px;">11) Final Diagnosis: A0104, A0105, A0106</td>
            </tr>
        </table>
        <br/>
        <table width="100%" style="border-spacing: 0;">
            <tr>
                <td colspan="10" style="font-weight: bold; text-align: left;padding: 4px;">B: Details / Cost of Services</td>
            </tr>
           <tr>
               <td style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">INVESTIGATIONS</td>
               <td colspan="3" style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">MEDICINE IN GENERIC NAME</td>
               <td colspan="5" style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">IN PATIENT</td>
               <td  style="border:1px solid #000; font-weight: bold; text-align: center;padding: 4px;">SURGERY</td>
           </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Type</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Cost</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Name/Strength <br> Formulation/Duration</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Quantity</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Unit Price</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Cost</td>
                <td  colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">Admission (Date)</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Type of Surgery</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">Cost</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">SUB TOTAL</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td colspan="2" style="border:1px solid #000; text-align: center;padding: 4px;">SUB TOTAL</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">SUB TOTAL</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">SUB TOTAL</td>
                <td style="border:1px solid #000; text-align: center;padding: 4px;">&nbsp;</td>
            </tr>
        </table>
        <br/>
        <table width="100%">
            <tr>
                <td style="font-weight: bold; text-align: left;padding: 4px;">C: Name of the attending Clinician...........................</td>
                <td style="text-align: left;padding: 4px;">Qualification............................</td>
                <td style="text-align: left;padding: 4px;">Reg. No .............................</td>
                <td style="text-align: left;padding: 4px;">Signature...........................</td>
                <td style="text-align: left;padding: 4px;">Mobile No..........................</td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight: bold; text-align: left;padding: 4px;">D: Uthibitisho wa Mgonjwa/ Patient's certification</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;padding: 4px;">Nathibitisha kwamba nimepokea huduma zilizoainishwa hapo juu
                na natambua kwamba ni kosa kisheria kukiri kupata matibabu ambayo hajatolewa. <br/>
                    I certify that i received the above mentioned services as witnessed by my hereunder and I
                    understand that it is illigal to provide false testmony. <br/>
                    Jina (Name)............................... Sahihi (Signature)...................... Tarehe(Date)................. Namba ya Simu (Mobile No) ................... <br/>
                    Hakikisha unapata nakala ya fomu hii. (Make sure you receive a copy of this form indicating the services received)
                </td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight: bold; text-align: left;padding: 4px;">E: Description of In /Out-patient Management/ any other additional infromation (a separate sheet of a paper can be used)</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;padding: 4px;">.......................................................................................................
                </td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight: bold; text-align: left;padding: 4px;">F: Claimant's Certification</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;padding: 4px;">
                    I certify that I have provided the above service. Name: ................................... Signature: ............................ Official Stamp: ..............................
                </td>
            </tr>
        </table>
    </div>
@endsection
