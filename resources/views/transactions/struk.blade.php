<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk {{ $transaction->kode_transaksi }}</title>
    <style>
        /* ── RESET ── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Courier New', Courier, monospace;
            background: #d1d5db;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px 64px;
        }

        /* ── TOMBOL AKSI (hilang saat print) ── */
        .action-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 28px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        .btn-print {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
        }
        .btn-print:hover { background: #1d4ed8; transform: translateY(-1px); }
        .btn-close {
            background: #fff;
            color: #4b5563;
            border: 1.5px solid #d1d5db;
        }
        .btn-close:hover { background: #f3f4f6; }

        /* ── KERTAS STRUK ── */
        .receipt {
            background: #fff;
            width: 340px;
            padding: 28px 22px 32px;
            position: relative;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);

            /* Tepi bawah bergerigi */
            clip-path: polygon(
                0% 0%, 100% 0%,
                100% calc(100% - 10px),
                95%  100%,  90%  calc(100% - 10px),
                85%  100%,  80%  calc(100% - 10px),
                75%  100%,  70%  calc(100% - 10px),
                65%  100%,  60%  calc(100% - 10px),
                55%  100%,  50%  calc(100% - 10px),
                45%  100%,  40%  calc(100% - 10px),
                35%  100%,  30%  calc(100% - 10px),
                25%  100%,  20%  calc(100% - 10px),
                15%  100%,  10%  calc(100% - 10px),
                5%   100%,  0%   calc(100% - 10px)
            );
            padding-bottom: 42px;
        }

        /* ── GARIS PEMISAH ── */
        .line-solid { border: none; border-top: 2px solid #111; margin: 12px 0; }
        .line-dash  { border: none; border-top: 1.5px dashed #bbb; margin: 10px 0; }

        /* ── HEADER ── */
        .header { text-align: center; margin-bottom: 6px; }
        .toko-nama {
            font-size: 18px;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #111;
        }
        .toko-tagline {
            font-size: 9.5px;
            color: #6b7280;
            letter-spacing: 1.5px;
            margin-top: 3px;
            text-transform: uppercase;
        }
        .toko-alamat {
            font-size: 10px;
            color: #6b7280;
            margin-top: 5px;
            line-height: 1.6;
        }
        .struk-label {
            text-align: center;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #374151;
            margin: 4px 0;
        }

        /* ── BARIS INFO ── */
        .row-info {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            font-size: 11px;
            color: #374151;
            margin: 5px 0;
            line-height: 1.5;
        }
        .row-info .lbl { color: #6b7280; white-space: nowrap; }
        .row-info .val {
            font-weight: 600;
            text-align: right;
            max-width: 200px;
            word-break: break-word;
        }

        /* ── SEKSI LABEL ── */
        .section-label {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 7px;
        }

        /* ── ITEM LAYANAN ── */
        .item-name {
            font-size: 12px;
            font-weight: 800;
            color: #111;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .item-calc {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #4b5563;
        }

        /* ── STATUS BADGE ── */
        .badge {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 3px;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1.5px solid;
        }
        .badge-baru     { color: #0369a1; border-color: #0369a1; }
        .badge-proses   { color: #d97706; border-color: #d97706; }
        .badge-selesai  { color: #16a34a; border-color: #16a34a; }
        .badge-diambil  { color: #7c3aed; border-color: #7c3aed; }

        /* ── AREA TOTAL ── */
        .row-subtotal {
            display: flex;
            justify-content: space-between;
            font-size: 11.5px;
            color: #374151;
            margin: 5px 0;
        }
        .row-total {
            display: flex;
            justify-content: space-between;
            font-size: 15px;
            font-weight: 900;
            color: #111;
            margin: 6px 0 4px;
            letter-spacing: 0.5px;
        }
        .row-bayar {
            display: flex;
            justify-content: space-between;
            font-size: 11.5px;
            color: #374151;
            margin: 5px 0;
        }
        .row-kembali {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 800;
            color: #111;
            margin: 5px 0;
        }

        /* ── JENIS BAYAR ── */
        .payment-method {
            display: inline-block;
            background: #111;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 3px;
        }

        /* ── BARCODE DEKORATIF ── */
        .barcode-wrap { text-align: center; margin-top: 14px; }
        .barcode-bars {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 1.5px;
            height: 40px;
            margin-bottom: 5px;
        }
        .barcode-bars span { display: inline-block; background: #111; }
        .barcode-num { font-size: 9px; letter-spacing: 4px; color: #6b7280; }

        /* ── FOOTER ── */
        .footer { text-align: center; margin-top: 8px; }
        .footer-thanks {
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #111;
        }
        .footer-note {
            font-size: 9.5px;
            color: #9ca3af;
            margin-top: 5px;
            line-height: 1.7;
        }

        /* ── PRINT ── */
        @media print {
            @page { size: 80mm auto; margin: 0; }
            body {
                background: #fff;
                padding: 0;
                display: block;
            }
            .action-bar { display: none !important; }
            .receipt {
                box-shadow: none;
                clip-path: none;
                width: 100%;
                padding: 12px 14px 24px;
            }
        }
    </style>
</head>
<body>

    {{-- ── STRUK ── --}}
    <div class="receipt">

        {{-- HEADER --}}
        <div class="header">
            <div class="toko-nama">✦ secreat Laundry ✦</div>
            <div class="toko-tagline">Bersih · Wangi · Tepat Waktu</div>
            <div class="toko-alamat">
                Jl. Contoh No. 1, Kota Kamu<br>
                Telp: 0812-xxxx-xxxx
            </div>
        </div>

        <hr class="line-solid">
        <div class="struk-label">— Struk Transaksi —</div>
        <hr class="line-dash">

        {{-- INFO NOTA --}}
        <div class="row-info">
            <span class="lbl">No. Nota</span>
            <span class="val">{{ $transaction->kode_transaksi }}</span>
        </div>
        <div class="row-info">
            <span class="lbl">Tgl Masuk</span>
            <span class="val">
                {{ \Carbon\Carbon::parse($transaction->tanggal_masuk)->isoFormat('D MMM Y') }}
            </span>
        </div>
        <div class="row-info">
            <span class="lbl">Tgl Ambil</span>
            <span class="val">
                @if($transaction->tanggal_ambil)
                    {{ \Carbon\Carbon::parse($transaction->tanggal_ambil)->isoFormat('D MMM Y') }}
                @else
                    <em style="color:#e57373">Belum ditentukan</em>
                @endif
            </span>
        </div>
        <div class="row-info">
            <span class="lbl">Status</span>
            <span class="val">
                @php $st = strtolower($transaction->status ?? 'baru'); @endphp
                @if($st === 'selesai')
                    <span class="badge badge-selesai">Selesai</span>
                @elseif($st === 'proses')
                    <span class="badge badge-proses">Proses</span>
                @elseif($st === 'diambil')
                    <span class="badge badge-diambil">Diambil</span>
                @else
                    <span class="badge badge-baru">Baru</span>
                @endif
            </span>
        </div>

        <hr class="line-dash">

        {{-- DATA PELANGGAN --}}
        <div class="section-label">Pelanggan</div>
        <div class="row-info">
            <span class="lbl">Nama</span>
            <span class="val">{{ $transaction->customer->nama ?? '-' }}</span>
        </div>
        <div class="row-info">
            <span class="lbl">Telepon</span>
            <span class="val">{{ $transaction->customer->no_hp ?? '-' }}</span>
        </div>

        <hr class="line-dash">

        {{-- DETAIL LAYANAN --}}
        <div class="section-label">Detail Layanan</div>
        <div class="item-name">{{ $transaction->service->nama_service ?? '-' }}</div>
        <div class="item-calc">
            <span>
                {{ number_format($transaction->berat, 1) }} kg
                &times;
                Rp {{ number_format($transaction->service->harga_per_kg ?? 0, 0, ',', '.') }}/kg
            </span>
            <span><strong>Rp {{ number_format($transaction->sub_total, 0, ',', '.') }}</strong></span>
        </div>

        <hr class="line-dash">

        {{-- PERHITUNGAN HARGA --}}
        <div class="row-subtotal">
            <span>Sub Total</span>
            <span>Rp {{ number_format($transaction->sub_total, 0, ',', '.') }}</span>
        </div>

        @if($transaction->diskon > 0)
        <div class="row-subtotal">
            <span>Diskon ({{ $transaction->diskon }}%)</span>
            <span style="color:#e53e3e">
                - Rp {{ number_format($transaction->sub_total * $transaction->diskon / 100, 0, ',', '.') }}
            </span>
        </div>
        @endif

        <hr class="line-solid">

        <div class="row-total">
            <span>TOTAL</span>
            <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
        </div>

        <hr class="line-dash">

        {{-- PEMBAYARAN --}}
        <div class="section-label">Pembayaran</div>
        <div class="row-bayar">
            <span>Jenis Bayar</span>
            <span>
                <span class="payment-method">
                    {{ strtoupper($transaction->jenis_pembayaran ?? 'tunai') }}
                </span>
            </span>
        </div>
        <div class="row-bayar">
            <span>Status Bayar</span>
            <span>
                <strong>{{ ucfirst($transaction->status_bayar ?? '-') }}</strong>
            </span>
        </div>

        @php
            $dibayar   = $transaction->dibayar ?? $transaction->total;
            $kembalian = max(0, $dibayar - $transaction->total);
        @endphp

        <div class="row-bayar">
            <span>Dibayar</span>
            <span><strong>Rp {{ number_format($dibayar, 0, ',', '.') }}</strong></span>
        </div>
        <div class="row-kembali">
            <span>Kembalian</span>
            <span>Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
        </div>

        <hr class="line-dash">

        {{-- BARCODE DEKORATIF --}}
        <div class="barcode-wrap">
            <div class="barcode-bars" id="barcodeEl"></div>
            <div class="barcode-num">{{ $transaction->kode_transaksi }}</div>
        </div>

        <hr class="line-dash">

        {{-- FOOTER --}}
        <div class="footer">
            <div class="footer-thanks">✦ Terima Kasih ✦</div>
            <div class="footer-note">
                Tunjukkan struk ini saat pengambilan.<br>
                Komplain melebihi 24 jam tidak dilayani.<br>
                Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
            </div>
        </div>

        {{-- ── TOMBOL AKSI ── --}}
        <div class="action-bar">
            <button class="btn btn-print" onclick="window.print()">
                🖨️ &nbsp; Cetak Struk
            </button>
            <button class="btn btn-close" onclick="window.close()">
                ✕ &nbsp; Tutup
            </button>
        </div>

    </div>{{-- end .receipt --}}

    <script>
        // Barcode dekoratif — deterministik berdasar kode transaksi
        (function() {
            const seed = '{{ addslashes($transaction->kode_transaksi) }}'
                .split('').reduce((a, c) => a + c.charCodeAt(0), 0);
            const container = document.getElementById('barcodeEl');
            const bars = 48;
            for (let i = 0; i < bars; i++) {
                const el = document.createElement('span');
                const h  = 14 + ((seed * (i + 3) * 17 + i * 7) % 26);
                const w  = (i % 7 === 0) ? 4 : (i % 4 === 0) ? 1 : 2;
                el.style.height = h + 'px';
                el.style.width  = w + 'px';
                container.appendChild(el);
            }
        })();
    </script>

</body>
</html>