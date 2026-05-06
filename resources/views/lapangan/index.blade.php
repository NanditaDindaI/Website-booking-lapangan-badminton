@extends('layouts.app')

@section('title', 'Data Lapangan')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Lapangan</h1>
    <a href="/lapangan/create"
        class="gradient-btn text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition">
        + Tambah Lapangan
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($lapangan as $l)
    <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-md transition">

        @if($l->foto)
            <img src="{{ asset('storage/' . $l->foto) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                <span class="text-4xl">🏸</span>
            </div>
        @endif

        <div class="p-4">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-bold text-gray-800">{{ $l->nama_lapangan }}</h2>
                @if($l->status == 'tersedia')
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-semibold">Tersedia</span>
                @elseif($l->status == 'terpesan')
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-semibold">Terpesan</span>
                @else
                    <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-semibold">Libur</span>
                @endif
            </div>

            <p class="text-green-600 font-semibold text-sm mb-1">
                Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }} / jam
            </p>
            <p class="text-gray-500 text-xs mb-1">
                🏟️ {{ $l->tipe_lapangan }} · 👥 {{ $l->kapasitas }} orang
            </p>

            @if($l->deskripsi)
                <p class="text-gray-600 text-xs mb-2">{{ $l->deskripsi }}</p>
            @endif

            @if($l->fasilitas)
                <p class="text-gray-500 text-xs mb-3">🎯 {{ $l->fasilitas }}</p>
            @endif

            <div class="flex gap-2 mt-3">
                <a href="/lapangan/{{ $l->id }}/edit"
                    class="gradient-btn text-white px-3 py-1 rounded-lg text-xs font-medium hover:opacity-90 transition">
                    Edit
                </a>
                <form action="/lapangan/{{ $l->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Yakin hapus lapangan ini?')"
                        class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs font-medium hover:opacity-90 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
        <div class="col-span-3 text-center py-12 text-gray-400">
            <p class="text-4xl mb-2">🏸</p>
            <p>Belum ada lapangan.</p>
        </div>
    @endforelse
</div>

@endsection