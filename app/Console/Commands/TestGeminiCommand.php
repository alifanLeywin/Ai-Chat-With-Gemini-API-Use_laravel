<?php

namespace App\Console\Commands;

use App\Services\GeminiService;
use Illuminate\Console\Command;

class TestGeminiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gemini:test {prompt?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Gemini API integration';

    protected GeminiService $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        parent::__construct();
        $this->geminiService = $geminiService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prompt = $this->argument('prompt') ?? 'Explain how AI works in a few words';
        
        $this->info('Testing Gemini API integration...');
        $this->line('================================');
        $this->newLine();
        
        $this->info("Prompt: {$prompt}");
        $this->info('Sending request to Gemini API...');
        
        $response = $this->geminiService->generateContent($prompt);
        
        if ($response['success']) {
            $this->newLine();
            $this->line('Response:');
            $this->line('--------');
            $this->line($response['message']);
            $this->newLine();
            $this->info('✅ API integration working correctly!');
        } else {
            $this->newLine();
            $this->error('❌ Error: ' . $response['message']);
            if (isset($response['error'])) {
                $this->line('Details: ' . $response['error']);
            }
        }
        
        $this->newLine();
    }
}
