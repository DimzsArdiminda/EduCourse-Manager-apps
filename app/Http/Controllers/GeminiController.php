<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;

class GeminiController extends Controller
{
    protected $apiKey;
    protected $apiUrl;
    protected $httpClient;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-pro:generateContent?key=' . $this->apiKey;
        $this->httpClient = new Client();
    }

    public function showForm()
    {
        return view('gemini');
    }

    public function generateText(Request $request)
    {
        $request->validate([
            'text' => 'required|string|min:3',
        ]);

        $prompt = $request->input('text');

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
                    if (isset($candidate['content']['parts'])) {
                        foreach ($candidate['content']['parts'] as $part) {
                            if (isset($part['text'])) {
                                return view('gemini', [
                                    'response' => $part['text']
                                ]);
                            }
                        }
                    }
                }
            }

            return view('gemini', ['error' => 'No response text found in response']);
        } catch (Exception $e) {
            return view('gemini', [
                'error' => 'Error communicating with Gemini API: ' . $e->getMessage()
            ]);
        }
    }
}
