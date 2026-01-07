<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation - Dimitria Bali</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 40px 20px;
            font-size: 14px;
            line-height: 1.5;
            -webkit-print-color-adjust: exact;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 48px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 48px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 24px;
        }

        .company-details h1 {
            color: #2c5f5d;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .company-details p {
            margin: 2px 0;
            color: #4b5563;
            font-size: 13px;
        }

        .quotation-meta {
            text-align: right;
        }

        .quotation-title {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            margin: 0 0 12px 0;
            letter-spacing: -0.5px;
        }

        .meta-group {
            margin-bottom: 4px;
        }

        .meta-label {
            color: #6b7280;
            font-weight: 500;
            margin-right: 8px;
        }

        .meta-value {
            font-weight: 600;
            color: #111827;
        }

        /* CLIENT INFO */
        .client-section {
            margin-bottom: 40px;
        }

        .section-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        .client-info h3 {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .client-info p {
            margin: 0;
            color: #4b5563;
        }

        /* TABLE */
        .table-container {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }

        /* EDITABLE INPUTS */
        .editable-input {
            width: 100%;
            border: 1px solid transparent;
            padding: 8px;
            border-radius: 4px;
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            background: transparent;
            transition: all 0.2s;
        }

        .editable-input:hover,
        .editable-input:focus {
            background-color: #f9fafb;
            border-color: #d1d5db;
            outline: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .amount-col {
            width: 15%;
            font-family: 'Inter', monospace;
        }

        /* SUMMARY SECTION */
        .summary-section {
            display: flex;
            justify-content: space-between;
            gap: 48px;
            margin-bottom: 48px;
        }

        .bank-info {
            flex: 1;
            background-color: #f8fafc;
            padding: 24px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .bank-info-header {
            font-weight: 600;
            color: #2c5f5d;
            margin-bottom: 16px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bank-field-group {
            margin-bottom: 12px;
        }

        .bank-label {
            display: block;
            font-size: 11px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .bank-input {
            width: 100%;
            font-weight: 500;
            color: #334155;
            border: none;
            background: transparent;
            padding: 4px 0;
            font-size: 14px;
        }

        .bank-input:focus {
            outline: none;
            border-bottom: 1px solid #2c5f5d;
        }

        .totals-box {
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .total-row:last-child {
            border-bottom: none;
        }

        .total-row span:first-child {
            color: #6b7280;
        }

        .total-row span:last-child {
            font-weight: 600;
            color: #1f2937;
        }

        .grand-total {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 2px solid #1f2937;
            align-items: center;
        }

        .grand-total span:first-child {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .grand-total span:last-child {
            font-size: 20px;
            font-weight: 700;
            color: #2c5f5d;
        }

        /* NOTES */
        .notes-section {
            margin-bottom: 48px;
            border-top: 1px dashed #e5e7eb;
            padding-top: 24px;
        }

        .notes-list {
            list-style: none;
            padding: 0;
            margin: 0;
            color: #6b7280;
            font-size: 12px;
        }

        .notes-list li {
            position: relative;
            padding-left: 16px;
            margin-bottom: 6px;
        }

        .notes-list li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2c5f5d;
        }

        /* SIGNATURE */
        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
        }

        .signature-block {
            text-align: center;
            width: 200px;
        }

        .signature-date {
            color: #6b7280;
            margin-bottom: 48px;
        }

        .signature-line {
            border-bottom: 1px solid #d1d5db;
            margin-bottom: 8px;
            height: 48px;
        }

        .signer-name {
            font-weight: 700;
            color: #1f2937;
            display: block;
        }

        .signer-role {
            font-size: 12px;
            color: #6b7280;
        }

        /* BUTTONS (No Print) */
        .actions {
            margin-top: 40px;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 16px;
        }

        .btn {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            color: #374151;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }

        .btn-primary {
            background-color: #2c5f5d;
            border-color: #2c5f5d;
            color: white;
        }

        .btn-primary:hover {
            background-color: #234e4c;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }

            .actions {
                display: none;
            }

            .editable-input::placeholder {
                color: transparent;
            }

            .bank-input::placeholder {
                color: transparent;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- HEADER -->
        <header class="header">
            <div class="company-details">
                <h1>Dimitria Bali</h1>
                <p>Jalan Intaran Gg. III No. 2, Sanur Kauh</p>
                <p>Denpasar Selatan, Bali</p>
                <p>Telp: 0853 3913 6388</p>
            </div>
            <div class="quotation-meta">
                <div class="quotation-title">QUOTATION</div>
                <div class="meta-group">
                    <span class="meta-label">No:</span>
                    <span class="meta-value">QTN-001</span>
                </div>
                <div class="meta-group">
                    <span class="meta-label">Date:</span>
                    <span class="meta-value" id="date"></span>
                </div>
            </div>
        </header>

        <!-- CLIENT INFO -->
        <section class="client-section">
            <span class="section-label">Quotation For</span>
            <div class="client-info">
                <h3>Mal Bali Galeria</h3>
                <p>Jl. By Pass Ngurah Rai, Kuta, Badung, Bali</p>
            </div>
        </section>

        <!-- ITEMS TABLE -->
        <section class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 45%">Description</th>
                        <th style="width: 10%; text-align: center;">Qty</th>
                        <th class="text-right" style="width: 20%">Unknown Price</th>
                        <th class="text-right" style="width: 20%">Amount</th>
                    </tr>
                </thead>
                <tbody id="items">
                    <tr>
                        <td>1</td>
                        <td><input class="editable-input" value="Zoom Meeting 1 Tahun (100 User)"></td>
                        <td><input class="editable-input text-center" oninput="calculate()" value="1"></td>
                        <td><input class="editable-input text-right" oninput="calculate()" value="3300000"></td>
                        <td class="text-right amount-col">0</td>
                    </tr>
                    {{-- <tr>
                        <td>1</td>
                        <td><input class="editable-input" value="Domain .com"></td>
                        <td><input class="editable-input text-center" oninput="calculate()" value="1"></td>
                        <td><input class="editable-input text-right" oninput="calculate()" value="375000"></td>
                        <td class="text-right amount-col">0</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><input class="editable-input" value="Domain .co.id"></td>
                        <td><input class="editable-input text-center" oninput="calculate()" value="1"></td>
                        <td><input class="editable-input text-right" oninput="calculate()" value="375000"></td>
                        <td class="text-right amount-col">0</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><input class="editable-input" value="Hosting 1 Tahun"></td>
                        <td><input class="editable-input text-center" oninput="calculate()" value="1"></td>
                        <td><input class="editable-input text-right" oninput="calculate()" value="4700000"></td>
                        <td class="text-right amount-col">0</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><input class="editable-input" value="Email Per Account/Month (min 1 year)"></td>
                        <td><input class="editable-input text-center" oninput="calculate()" value="1"></td>
                        <td><input class="editable-input text-right" oninput="calculate()" value="420000"></td>
                        <td class="text-right amount-col">0</td>
                    </tr> --}}
                </tbody>
            </table>
        </section>

        <!-- SUMMARY (Bank & Totals) -->
        <section class="summary-section">
            <!-- Bank Info -->
            <div class="bank-info">
                <div class="bank-info-header">
                    <span>💳 Payment Information</span>
                </div>
                <div class="bank-field-group">
                    <span class="bank-label">Bank Name</span>
                    <input type="text" class="bank-input" id="bankName" value="Bank Mandiri"
                        placeholder="Enter Bank Name">
                </div>
                <div class="bank-field-group">
                    <span class="bank-label">Account Number</span>
                    <input type="text" class="bank-input" id="accountNumber" value="1450013393976"
                        placeholder="Enter Account Number">
                </div>
                <div class="bank-field-group">
                    <span class="bank-label">Account Name</span>
                    <input type="text" class="bank-input" id="accountName" value=" I Gusti Agung Satria Nugraha"
                        placeholder="Enter Account Name">
                </div>
            </div>

            <!-- Totals -->
            <div class="totals-box">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div class="total-row">
                    <span>Tax (0%)</span> <!-- CHANGED -->
                    <span id="tax">Rp 0</span>
                </div>
                <!-- Line Separator is handled by border-bottom in css -->
                <div class="total-row grand-total">
                    <span>Total Due</span>
                    <span id="grandtotal">Rp 0</span>
                </div>
            </div>
        </section>

        <!-- TERMS -->
        {{-- <section class="notes-section">
            <span class="section-label">Terms & Conditions</span>
            <ul class="notes-list">
                <li>Pembayaran dilakukan 100% di awal sebelum proses dimulai.</li>
                <li>Quotation ini berlaku selama 7 (tujuh) hari sejak tanggal diterbitkan.</li>
                <li>Proses migrasi domain dan hosting akan dilakukan setelah mendapatkan konfirmasi dan akses yang
                    diperlukan.</li>
                <li>Waktu pengerjaan dapat menyesuaikan dengan kecepatan respon dan kelengkapan data.</li>
                <li>Perubahan scope pekerjaan di luar yang telah tercantum akan dikenakan biaya tambahan.</li>
                <li>Keterlambatan faktor eksternal berada di luar tanggung jawab penyedia jasa.</li>
            </ul>
        </section> --}}

        <!-- SIGNATURE -->
        <section class="signature-section">
            <div class="signature-block">
                <div class="signature-date">Denpasar, <span id="date2"></span></div>
                <div class="signature-line"></div> <!-- Space for signature -->
                <span class="signer-name">Satria Nugraha</span>
                <span class="signer-role">Dimitria Bali</span>
            </div>
        </section>

        <!-- ACTION BUTTONS -->
        <div class="actions">
            <button class="btn" onclick="addRow()">
                <span>+ Add Item</span>
            </button>
            <button class="btn btn-primary" onclick="window.print()">
                <span>Print Quotation</span>
            </button>
        </div>
    </div>

    <script>
        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        function calculate() {
            let rows = document.querySelectorAll("#items tr");
            let subtotal = 0;

            rows.forEach((row) => {
                let qtyInput = row.cells[2].querySelector("input");
                let priceInput = row.cells[3].querySelector("input");

                let qty = parseFloat(qtyInput.value) || 0;
                let price = parseFloat(priceInput.value) || 0;

                let total = qty * price;

                // Update row total
                row.cells[4].innerText = formatRupiah(total);
                subtotal += total;
            });

            // Calculate Tax (0%)
            let tax = 0; // Fixed at 0%

            document.getElementById("subtotal").innerText = formatRupiah(subtotal);
            document.getElementById("tax").innerText = formatRupiah(tax);
            document.getElementById("grandtotal").innerText = formatRupiah(subtotal + tax);
        }

        function addRow() {
            let table = document.getElementById("items");
            let index = table.rows.length + 1;

            let row = table.insertRow();
            row.innerHTML = `
            <td>${index}</td>
            <td><input class="editable-input" placeholder="Item Description"></td>
            <td><input class="editable-input text-center" oninput="calculate()" value="1"></td>
            <td><input class="editable-input text-right" oninput="calculate()" value="0"></td>
            <td class="text-right amount-col">0</td>
        `;
        }

        // Initialize Dates
        const date = new Date();
        const options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };

        // Yesterday's date logic if preferred, or today's date
        // Since original code had yesterday, I'll keep it consistent or use today if standard.
        // Let's use today's date for a clean slate, or stick to the logic provided.
        // Stick to simple today's date for a clean generator or the specific logic requested previously?
        // Previous logic was specific: "yesterday". I'll keep it "yesterday" to match previous logic perfectly in case it was a specific business rule.
        date.setDate(date.getDate() - 1);

        const dateString = date.toLocaleDateString("id-ID", options);

        document.getElementById("date").innerText = dateString;
        document.getElementById("date2").innerText = dateString;

        // Initial Calculation
        calculate();
    </script>
</body>

</html>
