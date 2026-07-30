@extends('admin.layout')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-semibold mb-4">Keluhan dari User</h1>

    <div class="bg-white rounded-lg shadow-lg p-4">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Pesan</th>
                    <th class="p-2 border">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($complaints as $complaint)
                    <tr>
                        <td class="p-2 border">{{ $complaint->name }}</td>
                        <td class="p-2 border">{{ $complaint->email }}</td>
                        <td class="p-2 border">{{ $complaint->message }}</td>
                        <td class="p-2 border">{{ $complaint->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 p-4">Belum ada keluhan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $complaints->links() }}
    </div>
</div>
@endsection