<?php

namespace Utils;

class HttpClient {
    /**
     * Sends a POST request to a specified URL.
     *
     * @param string $url The target URL.
     * @param array $options Optional settings:
     *                       - 'json': array of data to be sent as JSON.
     *                       - 'headers': associative array of custom headers.
     * @return mixed Response from the server or false on failure.
     */
    public function post(string $url, array $options = []) {
        $ch = curl_init($url);

        // Default headers
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        // Add custom headers if provided
        if (isset($options['headers']) && is_array($options['headers'])) {
            foreach ($options['headers'] as $key => $value) {
                $headers[] = "$key: $value";
            }
        }

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Add JSON payload if provided
        if (isset($options['json'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options['json']));
        }

        // Execute request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            // Log error if logging mechanism exists (omitted for simplicity)
            // error_log('cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return [
            'status' => $httpCode,
            'body' => $response
        ];
    }
}
