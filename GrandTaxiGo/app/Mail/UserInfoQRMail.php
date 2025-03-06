<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;





class UserInfoQRMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $qrData = "Nom: {$this->user->f_name} {$this->user->l_name}\n Email: {$this->user->email}\n Location: {$this->user->location}";
        
        $qrCode = new QrCode($qrData);
        
        $writer = new PngWriter();
        
        $qrImageData = $writer->write($qrCode);

        
        $qrFilePath = storage_path('app/public/qrcodes/user_' . $this->user->id . '_qr.png');

        $directory = storage_path('app/public/qrcodes');
        // dd($directory);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        file_put_contents($qrFilePath, $qrImageData->getString());
        
        return $this->subject('QR Code avec les informations de l\'utilisateur')
                    ->view('userInfoQR') 
                    ->attach($qrFilePath, [
                        'as' => 'user_info_qr.png',
                        'mime' => 'image/png',
                    ]);
    }
}




