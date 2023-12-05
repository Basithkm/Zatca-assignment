<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            line-height: 1.5;
            font-family: 'DejaVuSans', 'sans-serif';
            color: #333542;
            margin: 0;
            padding: 0;
        }

        div {
            font-size: 1rem;
        }

        .gry-color *,
        .gry-color {
            color: #878f9c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        table th,
        table td {
            border: 1px solid #eceff4;
            padding: .7rem;
            text-align: left;
        }

        table th {
            background: #eceff4;
            font-weight: normal;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .small {
            font-size: .85rem;
        }

        .strong {
            font-weight: bold;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            table th,
            table td {
                padding: .5rem;
                font-size: 0.9rem;
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            table th {
                text-align: left;
            }

            tbody {
                display: block;
            }

            tr {
                margin-bottom: 1rem;
                display: block;
            }

            td:before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 0.5rem;
            }
        }

        /* A4 Page Size Styles */
        @media print {
            body {
                width: 210mm;
                height: 297mm;
                margin: 20mm;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            td,
            th {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <div style="background: #eceff4;padding: 1.5rem;">
        <table>
            <tr>
                <td style="font-size: 1.5rem;" class="text-right strong">Complete Invoice Report</td>
            </tr>
        </table>
    </div>

    <div style="border-bottom:1px solid #eceff4;margin: 0 1.5rem;"></div>

    <div style="padding: 1.5rem;">
        <table class="text-left small">
            <thead>
                <tr class="gry-color">
                    <th>SN</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Invoice Amount</th>
                    <th>Invoice Date</th>
                    <th>Product name</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Total Amount</th>
                    <th>Tax Percentage</th>
                    <th>Tax Amount</th>
                    <th>Net Amount</th>
                    <th>Grand Total</th>
                </tr>
            </thead>
            <tbody class="strong">
                <?php $serialNumber = 1; ?>
                @foreach($master as $invoice)
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <td>{{ $invoice->customer_name }}</td>
                    <td>{{ $invoice->customer_email }}</td>
                    <td>{{ $invoice->invoice_amount }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->product_name }},
                        @endforeach
                    </td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->quantity }},
                        @endforeach
                    </td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->amount }},
                        @endforeach
                    </td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->total_amount }},
                        @endforeach
                    </td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->tax_percentage }},
                        @endforeach
                    </td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->tax_amount }},
                        @endforeach
                    </td>
                    <td>
                        @foreach($invoice->detail as $detail)
                        {{ $detail->net_amount }},
                        @endforeach
                    </td>
                    <td>{{ $invoice->invoice_amount }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4"></td>
                    <td><b>Total Amount</b></td>
                    <td></td>
                    <td></td>
                    <td><b>{{ $invoice->invoice_amount }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
