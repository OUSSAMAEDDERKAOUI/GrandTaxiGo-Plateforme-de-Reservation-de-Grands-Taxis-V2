<?php

namespace App\Mail;

use App\Models\Announcement;
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

    public $Announcement;

    /**
     * Create a new message instance.
     *
     * @param Announcement $Announcement
     */
    public function __construct(Announcement $Announcement)
    {
        $this->Announcement = $Announcement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $qrData = "Point de depart: {$this->Announcement->trip_start}\n Destination: {$this->Announcement->trip_end}\n  Nombre de personnes: {$this->Announcement->max_passengers}  \n Date de depart : {$this->Announcement->departure_date}" ;
        
        $qrCode = new QrCode($qrData);
        
        $writer = new PngWriter();
        
        $qrImageData = $writer->write($qrCode);

        
        $qrFilePath = storage_path('app/public/qrcodes/user_' . $this->Announcement->id . '_qr.png');

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




