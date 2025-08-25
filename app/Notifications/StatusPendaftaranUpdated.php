<?php

namespace App\Notifications;

use App\Models\Pendaftaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusPendaftaranUpdated extends Notification
{
    use Queueable;

    protected $pendaftaran;

    /**
     * Buat instance notifikasi baru.
     */
    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $status = $this->pendaftaran->status;
        $nama_user = $this->pendaftaran->user->name;
        $catatan = $this->pendaftaran->catatan_admin;

        // BENAR: Membuat instance baru dari MailMessage
        $mailMessage = (new MailMessage)
            ->subject('Update Status Pendaftaran Anda - Universitas Koding');

        if ($status === 'diverifikasi') {
            $mailMessage->greeting('Selamat, ' . $nama_user . '!')
                ->line('Kami dengan senang hati memberitahukan bahwa pendaftaran Anda di Universitas Koding telah DIVERIFIKASI.')
                ->line('Program Studi Pilihan: ' . $this->pendaftaran->programStudi->nama_prodi)
                ->line('Informasi mengenai langkah selanjutnya seperti pembayaran dan jadwal orientasi akan kami kirimkan dalam email terpisah.')
                ->action('Lihat Dashboard Anda', url('/dashboard'));
        } elseif ($status === 'ditolak') {
            $mailMessage->greeting('Pemberitahuan Status Pendaftaran, ' . $nama_user)
                ->line('Setelah melakukan peninjauan, dengan berat hati kami sampaikan bahwa pendaftaran Anda saat ini DITOLAK.')
                ->line('Program Studi Pilihan: ' . $this->pendaftaran->programStudi->nama_prodi)
                ->line('Catatan dari Admin: ' . ($catatan ?: 'Tidak ada catatan spesifik.'))
                ->line('Terima kasih telah berpartisipasi. Jangan ragu untuk mencoba lagi di kesempatan berikutnya.');
        }

        // Menambahkan baris terakhir lalu me-return seluruh objek MailMessage
        return $mailMessage->line('Terima kasih telah menggunakan layanan kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
