<?php

class LLM {
    public function generate($question, $context) {
        // This is a deterministic stub. 
        // In the future, this would call an API like OpenAI.
        
        $response = "Respuesta generada por el sistema basada en el contexto encontrado:\n\n";
        $response .= "Pregunta: " . htmlspecialchars($question) . "\n";
        $response .= "Contexto utilizado (" . strlen($context) . " caracteres):\n";
        
        // Simple heuristic: extract sentences from context that might answer the question?
        // For now, just summarize the context found.
        
        if (empty($context)) {
            return "No se encontró información relevante en la base de datos para responder a tu pregunta.";
        }

        $response .= "Basado en los artículos encontrados, aquí tienes un resumen:\n" . substr($context, 0, 500) . "...";

        return nl2br($response);
    }
}
