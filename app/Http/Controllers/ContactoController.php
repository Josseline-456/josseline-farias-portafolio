<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'mensaje.required' => 'El mensaje es obligatorio.',
        ]);

        $toAddress = config('mail.contact_to');

        if (!$toAddress) {
            Log::error('No está configurado MAIL_CONTACT_TO.');

            return redirect('/contacto')->withErrors([
                'email' => 'El correo de contacto no está configurado.',
            ]);
        }

        try {
            Log::info('Intento de envío de contacto', [
                'nombre' => $request->nombre,
                'email' => $request->email,
                'destinatario' => $toAddress,
            ]);

            Mail::to($toAddress)->send(
                new ContactoMail(
                    $request->nombre,
                    $request->email,
                    $request->mensaje
                )
            );

            Log::info('Correo de contacto enviado correctamente', [
                'destinatario' => $toAddress,
            ]);
        } catch (\Throwable $e) {
            report($e);

            Log::error('Error al enviar correo de contacto', [
                'message' => $e->getMessage(),
            ]);

            return redirect('/contacto')->withErrors([
                'email' => 'No se pudo enviar el mensaje. Revisa la configuración del correo.',
            ]);
        }

        return redirect('/contacto')->with(
            'success',
            '¡Mensaje enviado correctamente! Gracias por contactarme.'
        );
    }
}
