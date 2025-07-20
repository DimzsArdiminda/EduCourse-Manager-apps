<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class GeminiAIService
{
    protected  $apiKey;
    protected $apiUrl;
    protected $httpClient;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $this->apiKey;
        $this->httpClient = new Client();
    }

    public function generateGeminiResponse($prompt)
    {

        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->httpClient->post($this->apiUrl, [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['candidates']) && is_array($result['candidates']) && !empty($result['candidates'])) {

                foreach ($result['candidates'] as $candidate) {
                    if (isset($candidate['content']['parts']) && is_array($candidate['content']['parts']) && !empty($candidate['content']['parts'])) {
                        foreach ($candidate['content']['parts'] as $part) {
                            if (isset($part['text'])) {
                                return $part['text'];
                            }
                        }
                    }
                }
            }
            return 'No response text found in response';
        } catch (Exception $e) {
            throw new Exception('Error communicating with Gemini API: ' . $e->getMessage());
        }
    }
}
