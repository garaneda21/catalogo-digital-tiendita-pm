<?php

namespace App\Notifications;

use App\Models\Orden;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PagoAprobado extends Notification
{
    use Queueable;

    protected $orden;

    /**
     * Create a new notification instance.
     */
    public function __construct(Orden $orden)
    {
        $this->orden = $orden;
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
        $mail = (new MailMessage)
            ->subject('Confirmación de compra - Orden N° '.$this->orden->id)
            ->greeting('¡Gracias por tu compra, '.$notifiable->name.'!')
            ->line('Tu orden ha sido registrada con éxito.')
            ->line('Código de compra: '.$this->orden->buy_order)
            ->line('Monto total: $'.number_format($this->orden->monto_total, 0, ',', '.'))
            ->line('Resumen de tu pedido:');

        // Agregar productos en tabla tipo lista
        foreach ($this->orden->items as $item) {
            $producto = $item->producto;
            $mail->line("- {$producto->nombre_producto} x{$item->cantidad} - $".number_format($item->precio_unitario * $item->cantidad, 0, ',', '.'));
        }

        return $mail
            ->action('Ver detalles de tu pedido', url('/mi-cuenta/ordenes/'.$this->orden->id))
            ->line('Te enviaremos una notificación cuando el pedido esté en camino.');
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
