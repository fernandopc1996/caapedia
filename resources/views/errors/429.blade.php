@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('code', '429')

@php
    $messages = [
        "Ei, respira! Você tá clicando mais rápido que o vento no sertão!",
        "Você é rápido, mas o servidor precisa de um gole d'água.",
        "Devagar com o andor que o servidor é de barro!",
        "Muita sede ao pote! Tente novamente daqui a pouco.",
        "Oxente! Você pediu coisa demais. Dá uma respirada e tenta de novo.",
        "O servidor cansou... Foi tomar um cafezinho. Tente já já.",
        "Pausa para hidratação. Você fez muitas requisições de uma vez."
    ];

    $message = $messages[array_rand($messages)];
@endphp
@section('message', $message)
