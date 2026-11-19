<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Uji Pengiriman Email Survei Pet Friendly</title>
</head>
<body style="font-family: 'Work Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #F7F4EE; color: #1C201D; padding: 24px; margin: 0; line-height: 1.6;">
    <div style="max-width: 560px; margin: 0 auto; background-color: #FFFFFF; border: 1px solid #E2DDD1; border-radius: 8px; padding: 32px 28px;">
        <h2 style="color: #1F4E3D; margin-top: 0; font-size: 22px;">Pengaturan Email Berhasil</h2>
        <p style="font-size: 14px; line-height: 1.6;">
            Ini adalah email uji dari pengaturan pengiriman Survei Pet Friendly Mal Bali Galeria.
            Jika Anda menerima pesan ini, konfigurasi SMTP sudah berjalan dengan baik.
        </p>
        <div style="background-color: #FAF7F2; border: 1px solid #E2DDD1; border-radius: 6px; padding: 16px; margin: 20px 0; font-size: 13px;">
            <div style="margin-bottom: 6px;">
                <strong>Host:</strong> {{ $poll->mail_host }}:{{ $poll->mail_port ?: 587 }}
            </div>
            <div style="margin-bottom: 6px;">
                <strong>Username:</strong> {{ $poll->mail_username ?: '-' }}
            </div>
            <div>
                <strong>Enkripsi:</strong> {{ $poll->mail_encryption ? strtoupper($poll->mail_encryption) : 'Tanpa enkripsi' }}
            </div>
        </div>
        <p style="font-size: 12px; color: #5C6660; margin: 0;">
            Dikirim pada {{ now()->timezone('Asia/Makassar')->translatedFormat('d F Y, H:i') }} WITA.
        </p>
        <hr style="border: none; border-top: 1px solid #E2DDD1; margin: 24px 0 16px;">
        <p style="font-size: 11px; color: #5C6660; margin: 0; text-align: center;">
            Manajemen Mal Bali Galeria &middot; Simpang Dewa Ruci, Kuta, Bali
        </p>
    </div>
</body>
</html>
