{{-- container --}}
<div style="max-width: 1200px; margin: 0 auto; padding: 0 32px;">
    <div style="padding: 32px 0;">
        <h1 style="font-size: 24px; margin-bottom: 16px;">Data Kursus</h1>
        <p style="margin-bottom: 16px;">Berikut adalah data kursus yang tersedia di database.</p>
    <div style="padding: 32px 0;">
        <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin: 20px 0; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f4f4f4; text-align: left;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Nama Kursus</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Deskripsi</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Harga</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Jumlah Siswa Terdaftar</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Created At</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $course->Nama_kursus }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $course->Deskripsi }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($course->Harga, 0, ',', '.') }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color: {{ $course->Status == 'Aktif' ? 'green' : 'red' }};">
                        {{ $course->Status }}
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $course->jumlah_siswa_terdaftar ?? 0 }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $course->created_at }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $course->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
