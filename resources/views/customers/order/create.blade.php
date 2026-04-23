@extends('layouts.customer')

@section('title', 'Buat Pesanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-plus-circle mr-2"></i>Buat Pesanan Laundry</h5>
                </div>
                <form action="{{ route('customer.order.store') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Pilih Layanan --}}
                        <div class="form-group">
                            <label><i class="fas fa-cog mr-1 text-muted"></i> Pilih Layanan <span class="text-danger">*</span></label>
                            <select name="service_id" id="service_id"
                                class="form-control @error('service_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}"
                                    data-harga="{{ $service->harga }}"
                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->nama_service }}
                                    — Rp {{ number_format($service->harga, 0, ',', '.') }}/kg
                                </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Estimasi Berat --}}
                        <div class="form-group">
                            <label><i class="fas fa-weight mr-1 text-muted"></i> Estimasi Berat (kg) <span class="text-danger">*</span></label>
                            <input type="number" name="berat" id="berat"
                                class="form-control @error('berat') is-invalid @enderror"
                                value="{{ old('berat', 1) }}" min="1" step="0.5" required>
                            <small class="text-muted">Berat aktual akan ditimbang saat laundry diterima.</small>
                            @error('berat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Estimasi Harga --}}
                        <div class="form-group">
                            <label><i class="fas fa-money-bill mr-1 text-muted"></i> Estimasi Total Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" id="estimasi_harga" class="form-control bg-light"
                                    value="0" readonly>
                            </div>
                            <small class="text-muted">Harga final ditentukan setelah laundry ditimbang.</small>
                        </div>

                        {{-- Catatan --}}
                        <div class="form-group">
                            <label><i class="fas fa-sticky-note mr-1 text-muted"></i> Catatan (opsional)</label>
                            <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror"
                                rows="3" placeholder="Contoh: ada baju putih, jangan dicampur...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Info Box --}}
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pesanan kamu akan dikirim ke kasir untuk dikonfirmasi. Kamu akan melihat status pesanan di <strong>Riwayat Transaksi</strong>.
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('customer.transactions') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane mr-1"></i> Kirim Pesanan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    function hitungEstimasi() {
        const selectEl      = document.getElementById('service_id');
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        const berat         = parseFloat(document.getElementById('berat').value) || 0;
        const harga         = parseFloat(selectedOption?.dataset?.harga) || 0;
        const total         = harga * berat;

        document.getElementById('estimasi_harga').value =
            total > 0 ? total.toLocaleString('id-ID') : '0';
    }

    document.getElementById('service_id').addEventListener('change', hitungEstimasi);
    document.getElementById('berat').addEventListener('input', hitungEstimasi);
</script>
@endsection