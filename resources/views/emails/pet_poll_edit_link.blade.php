<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tautan Ubah Jawaban Survei Pet Friendly</title>
</head>
<body style="font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #F7F4EE; color: #1C201D; padding: 24px; margin: 0; line-height: 1.6;">
    <div style="max-width: 560px; margin: 0 auto; background-color: #FFFFFF; border: 1px solid #E2DDD1; border-radius: 8px; padding: 32px 28px;">
        <h2 style="color: #1F4E3D; margin-top: 0; font-size: 22px;">Survei Pet Friendly Mal Bali Galeria</h2>
        <p style="font-size: 15px; margin-bottom: 20px;">
            Halo <strong>{{ $response->tenant->name }}</strong>,
        </p>
        <p style="font-size: 14px; line-height: 1.6;">
            Terima kasih telah berpartisipasi dalam survei pet friendly. Keputusan Anda saat ini:
            <br>
            <strong style="color: #1F4E3D; font-size: 16px;">
                {{ $response->allows_pets ? 'Kami mengizinkan pet' : 'Kami tidak mengizinkan pet' }}
            </strong>
        </p>
        <p style="font-size: 14px; line-height: 1.6; margin-top: 20px;">
            Jika Anda perlu mengubah keputusan tenant Anda, gunakan tombol di bawah ini:
        </p>
        <div style="text-align: center; margin: 28px 0;">
            <a href="{{ $response->edit_url }}" style="display: inline-block; background-color: #1F4E3D; color: #FFFFFF; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-weight: 600; font-size: 14px;">
                Ubah Keputusan Tenant
            </a>
        </div>
        <p style="font-size: 12px; color: #5C6660; line-height: 1.5; word-break: break-all;">
            Atau salin tautan berikut ke peramban Anda:
            <br>
            <a href="{{ $response->edit_url }}" style="color: #1F4E3D;">{{ $response->edit_url }}</a>
        </p>
        @if($response->poll && $response->poll->closes_at)
            <p style="font-size: 12px; color: #C25E3E; margin-top: 20px;">
                Perubahan jawaban dapat dilakukan sampai {{ $response->poll->closes_at->timezone('Asia/Makassar')->format('d F Y, H:i') }} WITA.
            </p>
        @endif
        <hr style="border: none; border-top: 1px solid #E2DDD1; margin: 28px 0 16px;">
        <p style="font-size: 11px; color: #5C6660; margin: 0; text-align: center;">
            Manajemen Mal Bali Galeria &middot; Simpang Dewa Ruci, Kuta, Bali
        </p>
    </div>
</body>
</html>
