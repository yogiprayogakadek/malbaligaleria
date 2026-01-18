<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation V2</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: #fff;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }

        .logo-section img {
            max-width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            font-size: 42px;
            font-weight: 500;
            color: #333;
            margin: 0;
            letter-spacing: 1px;
        }

        .invoice-number {
            color: #666;
            font-size: 16px;
            margin-top: 5px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .bill-to p {
            margin: 5px 0;
            font-size: 14px;
        }

        .bill-to h3 {
            margin: 0 0 10px 0;
            font-size: 15px;
            font-weight: 700;
        }

        .invoice-details {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            font-size: 14px;
        }

        .detail-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 8px;
            width: 100%;
        }

        .detail-label {
            color: #888;
            margin-right: 20px;
            width: 120px;
            text-align: right;
        }

        .detail-value {
            font-weight: 500;
            text-align: right;
            width: 120px;
        }

        .balance-due-bar {
            background-color: #f6f6f6;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 10px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .balance-due-bar span {
            font-weight: 600;
            margin-left: 10px;
            font-size: 15px;
        }

        .balance-label {
            font-weight: 700 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th {
            background-color: #2d2d2d;
            color: #fff;
            text-align: left;
            padding: 12px 15px;
            font-weight: 500;
            font-size: 14px;
        }

        th:last-child {
            text-align: right;
        }

        th:nth-child(2),
        th:nth-child(3) {
            text-align: left;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            vertical-align: top;
        }

        td:last-child {
            text-align: right;
        }

        /* Adjust alignment based on image */
        th:nth-child(3),
        td:nth-child(3) {
            /* Rate */
            text-align: right;
        }

        .item-desc {
            font-weight: 600;
            display: block;
            margin-bottom: 2px;
            color: #333;
        }

        .totals-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .totals-grid {
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .total-row.final {
            font-weight: 700;
            font-size: 16px;
            border-top: 2px solid #eee;
            padding-top: 10px;
            margin-top: 10px;
        }

        .text-muted {
            color: #666;
        }

        /* Print Styles */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .balance-due-bar {
                background-color: #f6f6f6 !important;
                -webkit-print-color-adjust: exact;
            }

            th {
                background-color: #2d2d2d !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <div class="header-container">
        <div class="logo-section">
            <!-- Logo -->
            <img src="{{ asset('assets/images/LampuKuning.png') }}" alt="Lampu Kuning">

            <div class="bill-to" style="margin-top: 30px;">
                <h3>PT Samudera Media Teknologi</h3>
                <div style="margin-top: 20px;">
                    <p class="text-muted" style="margin-bottom: 5px;">Bill To:</p>
                    <h3>Mal Bali Galeria</h3>
                </div>
            </div>
        </div>

        <div class="invoice-title">
            <h1>INVOICE</h1>
            <div class="invoice-number"># 9663</div>

            <div class="invoice-details" style="margin-top: 40px;">
                <div class="detail-row">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value">Jan 9, 2026</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Terms:</span>
                    <span class="detail-value">TRANSFER</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Due Date:</span>
                    <span class="detail-value">Jan 17, 2026</span>
                </div>

                <div class="balance-due-bar">
                    <span class="balance-label">Balance Due:</span>
                    <span>IDR 1,900,000.00</span>
                </div>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 45%;">Item</th>
                <th style="width: 10%;">Quantity</th>
                <th style="width: 20%;">Rate</th>
                <th style="width: 25%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <span class="item-desc">Add on Hosting Storage 25GB (exp 31 January 2026)</span>
                </td>
                <td>1</td>
                <td>IDR 1,900,000.00</td>
                <td>IDR 1,900,000.00</td>
            </tr>
        </tbody>
    </table>

    <div class="totals-section">
        <div class="totals-grid">
            <div class="total-row">
                <span class="detail-label" style="text-align: left;">Subtotal:</span>
                <span class="detail-value">IDR 1,900,000.00</span>
            </div>
            <div class="total-row">
                <span class="detail-label" style="text-align: left;">Tax (0%):</span>
                <span class="detail-value">IDR 0.00</span>
            </div>
            <div class="total-row final">
                <span class="detail-label" style="text-align: left;">Total:</span>
                <span class="detail-value">IDR 1,900,000.00</span>
            </div>
        </div>
    </div>

</body>

</html>
