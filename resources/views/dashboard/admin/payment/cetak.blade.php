<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Transaction Report</title>

    <style>
        .invoice-box {
            width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        /* .invoice-box table tr td:nth-child(2) {
            text-align: right;
        } */

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.heading td {
            background: #B8860B;
            color: white;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="5" style="text-align: center">
                    <h1>LAPORAN TRANSAKSI</h1>
                    <h2>Electronic Shop <span style="color: rgb(21, 174, 221);"></span></h2>
                    <hr>
                </td>
            </tr>
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                Created: {{ date("d.m.Y H:i:s A", strtotime(now()))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td><b>Data Transaksi</td></tr>
            <tr class="heading">
                <th>No. Invoice</th>
                <th>Nama User</th>
                <th>Status Pembayaran</th>
                <th>Alamat</th>
                <th>Total Pembelian</th>
            </tr>

            @php
            $total= 0;
            @endphp

            @foreach($data as $item)
            <tr class="invoice" style="text-align: center">
                <td>
                    <span style="font-weight: bold;">#{{ $item->no_invoice }}</span>
                </td>
                <td>{{ $item->user->name }}</td>
                <td>{{ ($item->status == 1) ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}</td>
                <td>{{ $item->alamat->alamat }}</td>
                <td>Rp. {{ number_format($item->total) }}</td>
            </tr>
            @php
            $total += $item->total;
            @endphp
            @endforeach

            <tr class="total heading" style="text-align: center">
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold">TOTAL</td>
                <td style="font-weight: bold">{{ number_format($total, 0, ',', '.')}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
