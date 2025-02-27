<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirement Sign Off Sheet</title>
    <style>
        .container {
            width: 75% !important;
            padding: 100px;
            justify-content: center;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 1rem;
            background-image: url('{{ public_path("metronic/dist/assets/media/images/pict/pdf-template.png") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            margin-right: 20px;
            margin-bottom: 30px; 
            margin-left: 20px;  
        }
        .content {
            margin: 10px 0;
            break-before: auto;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        .content td {
            padding: 8px;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 30%;
            white-space: nowrap;
        }
        .value {
            width: 70%;
        }
        .signature-section {
            position: relative;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 150px;
        }
        .signature-item {
            position: absolute;
            text-align: center;
            width: 40%;
            margin: 0 5%;
        }
        .left-signature {
            left: -50px;
            text-align: center;
        }
        .right-signature {
            right: 3% !important;
            text-align: center;
        }
        .acceptance{
            padding-left: 55px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .label-acceptance, .label-userstory {
            padding-left: 10px;
        }
        .userstory {
            padding-left: 30px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .label-keterangan, .label-lampiran {
            padding-left: 10px; 
        }
        .keterangan, .lampiran {
            padding-left: 30px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">REQUIREMENT SIGN OFF SHEET</div>
        <div class="content">
            <table>
                <tr>
                    <td class="label">Project Name</td>
                    <td class="value">: {{ $productName }}</td>
                </tr>
                <tr>
                    <td class="label">Applicant Name</td>
                    <td class="value">: {{ $applicant }}</td>
                </tr>
                <tr>
                    <td class="label">Hari, Tanggal</td>
                    <td class="value">: {{ $hariTanggal }}</td>
                </tr>
            </table>
        </div>
        
        <div class="content">
            <p class="label-userstory"><strong>A. User Story</strong></p>
            <p class="userstory">{{ $userStory }}</p>
        </div>

        <div class="content">
            <p class="label-acceptance"><strong>B. Acceptance Criteria (DoD)</strong></p>
            <ol class="acceptance">
                @foreach ($acceptanceCriteria as $checklist)
                    <li>{{ $checklist->description }}</li>
                @endforeach
            </ol>
        </div>

        <div class="content">
            <p class="label-keterangan"><strong>C. Keterangan</strong></p>
            <p class="keterangan">{{ $keterangan ?? '-' }}</p>
        </div>

        <div class="content">
            <p class="label-lampiran"><strong>D. Lampiran</strong></p>
            <p class="lampiran" style="margin-top: 5px;">-</p>
        </div>        
        <br>

        <div class="signature-section">
            <div class="signature-item left-signature">
                <p>Mengetahui</p>
                <br><br>
                <p><strong>{{ $applicant }}</strong></p>
            </div>
            <div class="signature-item right-signature">
                <p>Dibuat Oleh</p>
                <br><br>
                <p><strong>{{ $backlog->user->name }}</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
