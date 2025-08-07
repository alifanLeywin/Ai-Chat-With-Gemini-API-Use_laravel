<?php
require_once 'vendor/autoload.php';

// Test Gemini API integration
use App\Services\GeminiService;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create a simple test
$geminiService = new GeminiService();

echo "Testing Gemini API integration...\n";
echo "================================\n\n";

$testPrompt = "Explain how AI works in a few words";

echo "Prompt: $testPrompt\n";
echo "Response: ";

$response = $geminiService->generateContent($testPrompt);

if ($response['success']) {
    echo $response['message'] . "\n";
    echo "\n✅ API integration working correctly!\n";
} else {
    echo "❌ Error: " . $response['message'] . "\n";
    if (isset($response['error'])) {
        echo "Details: " . $response['error'] . "\n";
    }
}

echo "\n";
