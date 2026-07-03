@extends('layouts.master')

@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen pt-20">
    <div class="mx-auto max-w-3xl px-4 py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-success/30 bg-success/10 p-4 text-sm font-medium text-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-8 text-3xl font-bold text-text-primary dark:text-white">Pembayaran</h1>

        {{-- Invoice Info --}}
        <div class="mb-8 rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <h2 class="mb-4 text-xl font-semibold text-text-primary dark:text-white">Detail Pendaftaran</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-text-secondary dark:text-gray-400">Kursus</span>
                    <span class="font-medium text-text-primary dark:text-white">{{ $enrollment->course->title }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-text-secondary dark:text-gray-400">Tipe</span>
                    <span class="font-medium text-text-primary dark:text-white">{{ $enrollment->course->type === 'online' ? 'Online' : 'Offline' }}</span>
                </div>
                <div class="border-t border-border pt-3 dark:border-gray-700">
                    <div class="flex justify-between text-base">
                        <span class="font-semibold text-text-primary dark:text-white">Total</span>
                        <span class="font-bold text-primary-start">Rp {{ number_format($enrollment->course->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bank Transfer Info --}}
        <div class="mb-8 rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <h2 class="mb-4 text-xl font-semibold text-text-primary dark:text-white">Panduan Pembayaran</h2>
            <p class="mb-4 text-sm text-text-secondary dark:text-gray-400">
                Lakukan transfer ke rekening berikut sesuai dengan total biaya di atas.
            </p>
            <div class="space-y-4">
                <div class="rounded-xl border border-border bg-surface p-4 dark:border-gray-600 dark:bg-dark-bg">
                    <p class="text-xs text-text-muted dark:text-gray-500">Bank Central Asia (BCA)</p>
                    <p class="font-mono text-lg font-bold text-text-primary dark:text-white">123 456 7890</p>
                    <p class="text-sm text-text-secondary dark:text-gray-400">a.n. PT Kursus Hobi Indonesia</p>
                </div>
                <div class="rounded-xl border border-border bg-surface p-4 dark:border-gray-600 dark:bg-dark-bg">
                    <p class="text-xs text-text-muted dark:text-gray-500">Bank Mandiri</p>
                    <p class="font-mono text-lg font-bold text-text-primary dark:text-white">987 654 3210</p>
                    <p class="text-sm text-text-secondary dark:text-gray-400">a.n. PT Kursus Hobi Indonesia</p>
                </div>
            </div>
        </div>

        {{-- Upload Form --}}
        <div class="rounded-2xl border border-border bg-surface-alt p-6 shadow-sm dark:border-gray-700 dark:bg-dark-surface">
            <h2 class="mb-4 text-xl font-semibold text-text-primary dark:text-white">Upload Bukti Transfer</h2>

            <form method="POST" action="{{ route('payments.store', $enrollment) }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="transfer_bank_name" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Bank Tujuan</label>
                    <select name="transfer_bank_name" id="transfer_bank_name" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                        <option value="">Pilih bank tujuan</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="Bank Lain">Bank Lain</option>
                    </select>
                    @error('transfer_bank_name')
                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="account_holder_name" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Nama Pemilik Rekening</label>
                    <input type="text" name="account_holder_name" id="account_holder_name" value="{{ old('account_holder_name') }}" required
                        class="w-full rounded-xl border border-border bg-white px-4 py-3 text-sm text-text-primary outline-none transition-colors focus:border-primary-start focus:ring-1 focus:ring-primary-start dark:border-gray-600 dark:bg-dark-bg dark:text-white">
                    @error('account_holder_name')
                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="proof_file" class="mb-1 block text-sm font-medium text-text-primary dark:text-gray-200">Upload Bukti Transfer</label>
                    <div class="mt-1 flex justify-center rounded-xl border-2 border-dashed border-border bg-surface px-6 py-10 dark:border-gray-600 dark:bg-dark-bg">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-text-muted dark:text-gray-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                            <p class="mt-2 text-sm text-text-secondary dark:text-gray-400">
                                <span class="font-medium text-primary-start">Klik untuk upload</span> atau drag & drop
                            </p>
                            <p class="text-xs text-text-muted dark:text-gray-500">JPG, PNG, WEBP (max 20 MB)</p>
                            <input type="file" name="proof_file" id="proof_file" accept="image/jpeg,image/png,image/webp" required class="mt-4 block w-full text-sm text-text-secondary file:mr-4 file:rounded-full file:border-0 file:bg-gradient-to-b file:from-[#2B7FFF] file:to-[#0065FF] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:opacity-90">
                        </div>
                    </div>
                    @error('proof_file')
                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                    @enderror
                    <div id="file-preview" class="mt-3 hidden">
                        <img id="preview-image" class="max-h-48 rounded-xl border border-border dark:border-gray-700" alt="Preview">
                    </div>
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-gradient-to-b from-[#2B7FFF] to-[#0065FF] px-6 py-3 text-sm font-medium text-white transition-all duration-150 hover:opacity-90">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const fileInput = document.getElementById('proof_file');
    const preview = document.getElementById('file-preview');
    const previewImage = document.getElementById('preview-image');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush
@endsection
