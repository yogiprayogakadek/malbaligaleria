<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            background: #fff;
            margin: auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            height: 60px;
            object-fit: contain;
        }

        .company h2 {
            color: #1e40af;
            margin: 0;
        }

        .company p {
            margin: 3px 0;
            color: #444;
            font-size: 13px;
        }

        .quotation-info {
            text-align: right;
            font-size: 14px;
        }

        .title {
            font-size: 28px;
            text-align: center;
            margin: 25px 0;
            color: #1e293b;
            letter-spacing: 2px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .info div {
            width: 48%;
        }

        .info p {
            margin: 6px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background: #1e40af;
            color: #fff;
        }

        th,
        td {
            padding: 12px 10px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
        }

        td input {
            border: none;
            width: 100%;
            background: transparent;
            text-align: center;
            outline: none;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .total {
            width: 300px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
        }

        .total div {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 15px;
        }

        .grand-total {
            font-weight: bold;
            font-size: 17px;
            border-top: 2px solid #1e40af;
            padding-top: 8px;
            margin-top: 5px;
            color: #1e40af;
        }

        .notes {
            margin-top: 25px;
            font-size: 14px;
            color: #333;
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
        }

        /* SIGNATURE */
        .signature-wrap {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-box {
            text-align: center;
            width: 260px;
        }

        .signature-space {
            height: 50px;
            margin-top: 5px;
            border-bottom: 1px solid #999;
        }

        .signature-name {
            margin-top: 8px;
            font-weight: 600;
        }

        .signature-role {
            font-size: 13px;
            color: #555;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            background: #1e40af;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                padding: 5px;
                border-radius: 0;
            }

            .actions {
                display: none;
            }

            input {
                pointer-events: none;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER + LOGO -->
        <div class="header">
            <div class="company-wrapper">
                {{-- <div class="logo">
                    <img src="{{ asset('assets/semicolon.png') }}" alt="Logo Perusahaan">
                </div> --}}

                <div class="company">
                    <h2>Dimitria Bali</h2>
                    <p>Jalan Intaran Gg. III No. 2, Sanur Kauh - Denpasar Selatan</p>
                    <p>Telp: 0853 3913 6388</p>
                    {{-- <p>Email: semicolon.code00@gmail.com | Telp: 0853 3913 6388</p> --}}
                </div>
            </div>

            <div class="quotation-info">
                <strong>No:</strong> QTN-001 <br>
                <strong>Date:</strong> <span id="date"></span>
            </div>
        </div>

        <div class="title">QUOTATION</div>

        <div class="info">
            <div>
                <p><strong>To:</strong> Mal Bali Galeria</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th class="text-left">Description</th>
                    <th width="10%">Qty</th>
                    <th width="20%">Unit Price</th>
                    <th width="20%">Total</th>
                </tr>
            </thead>
            <tbody id="items">
                <tr>
                    <td>1</td>
                    <td class="text-left"><input value="Domain .com"></td>
                    <td><input oninput="calculate()" value="1"></td>
                    <td><input oninput="calculate()" value="375000"></td>
                    <td class="text-right">0</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="text-left"><input value="Domain .co.id"></td>
                    <td><input oninput="calculate()" value="1"></td>
                    <td><input oninput="calculate()" value="375000"></td>
                    <td class="text-right">0</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="text-left"><input value="Hosting 1 Tahun"></td>
                    <td><input oninput="calculate()" value="1"></td>
                    <td><input oninput="calculate()" value="4700000"></td>
                    <td class="text-right">0</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="text-left"><input value="Email Per Account/Month (min 1 year)"></td>
                    <td><input oninput="calculate()" value="1"></td>
                    <td><input oninput="calculate()" value="420000"></td>
                    <td class="text-right">0</td>
                </tr>
            </tbody>
        </table>

        <div class="total-box">
            <div class="total">
                <div>
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div>
                    <span>PPN</span>
                    <span id="tax">Rp 0</span>
                </div>
                <div class="grand-total">
                    <span>TOTAL</span>
                    <span id="grandtotal">Rp 0</span>
                </div>
            </div>
        </div>

        <div class="notes">
            <strong>Notes:</strong>
            <p>1. Pembayaran dilakukan 100% di awal sebelum proses dimulai.</p>
            <p>2. Quotation ini berlaku selama 7 (tujuh) hari sejak tanggal diterbitkan.</p>
            <p>3. Proses migrasi domain dan hosting akan dilakukan setelah mendapatkan konfirmasi dan akses yang
                diperlukan dari vendor/penyedia layanan sebelumnya.</p>
            <p>4. Waktu pengerjaan dapat menyesuaikan dengan kecepatan respon dan kelengkapan data dari pihak terkait.
            </p>
            <p>5. Perubahan scope pekerjaan di luar yang telah tercantum dalam quotation ini akan dikenakan biaya
                tambahan dan akan dikonfirmasi terlebih dahulu kepada pihak pemesan.</p>
            <p>6. Segala bentuk keterlambatan yang disebabkan oleh faktor eksternal (vendor, jaringan, sistem pihak
                ketiga, atau force majeure) berada di luar tanggung jawab penyedia jasa.</p>
        </div>

        <div class="signature-wrap">
            <div class="signature-box">
                <div>Denpasar, <span id="date2"></span></div>
                <div class="signature-space"></div>
                <div class="signature-name">Satria Nugraha</div>
                <div class="signature-role">Dimitria Bali</div>
            </div>
        </div>

        <div class="actions">
            <button onclick="window.print()">Print / Save PDF</button>
            <button onclick="addRow()">Tambah Baris</button>
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
                let qty = parseFloat(row.cells[2].querySelector("input").value) || 0;
                let price = parseFloat(row.cells[3].querySelector("input").value) || 0;
                let total = qty * price;

                row.cells[4].innerText = formatRupiah(total);
                subtotal += total;
            });

            document.getElementById("subtotal").innerText = formatRupiah(subtotal);
            document.getElementById("grandtotal").innerText = formatRupiah(subtotal);
        }

        function addRow() {
            let table = document.getElementById("items");
            let index = table.rows.length + 1;

            let row = table.insertRow();
            row.innerHTML = `
            <td>${index}</td>
            <td class="text-left"><input placeholder="Item..."></td>
            <td><input oninput="calculate()" value="1"></td>
            <td><input oninput="calculate()" value="0"></td>
            <td class="text-right">0</td>
        `;
        }

        const today = new Date().toLocaleDateString("id-ID");
        document.getElementById("date").innerText = today;
        document.getElementById("date2").innerText = today;

        calculate();
    </script>

</body>

</html>
