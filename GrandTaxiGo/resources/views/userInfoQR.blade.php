<!-- resources/views/userInfoQR.blade.php -->

<html>
<body>
    <h1>Information utilisateur</h1>
    <p>Nom: {{ $user->f_name }} {{ $user->l_name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Location: {{ $user->location }}</p>

    <p>Ci-joint, votre QR Code :</p>
    <img src="{{ storage_path('app/public/qrcodes/user_' . $user->id . '_qr.png') }}" alt="QR Code">
</body>
</html>
