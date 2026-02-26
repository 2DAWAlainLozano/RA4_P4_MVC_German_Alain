<?php

namespace App\Services;

use App\Models\Post;

class RagService
{
    public function generateAnswer(string $question): string
    {
        // 1. Retrieve context using FullText search
        $posts = Post::whereRaw("MATCH(title, content) AGAINST(? IN NATURAL LANGUAGE MODE)", [$question])
            ->limit(5)
            ->get();

        $context = $posts->map(function ($post) {
            return $post->title . "\n" . $post->content;
        })->implode("\n\n");

        // 2. Mock generation
        $response = "Respuesta generada por el sistema basada en el contexto encontrado:\n\n";
        $response .= "Pregunta: " . htmlspecialchars($question) . "\n";
        $response .= "Contexto utilizado (" . strlen($context) . " caracteres):\n";
        
        if (empty($context)) {
            return "No se encontró información relevante en la base de datos para responder a tu pregunta.";
        }

        $response .= "Basado en los artículos encontrados, aquí tienes un resumen:\n" . substr($context, 0, 500) . "...";

        return nl2br($response);
    }
}
