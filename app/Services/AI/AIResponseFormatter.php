<?php

namespace App\Services\AI;

class AIResponseFormatter
{
    public function format(array $response, array $context): array
    {
        return [
            'status' => [
                'level' =>
                    $response['status']['level']
                        ?? $context['status']['level']
                        ?? 'info',
                'label' =>
                    $response['status']['label']
                        ?? $context['status']['label']
                        ?? 'AI Analysis Completed'
            ],
            'summary' => $this->cleanSummary(
                $response['summary'] ?? []
            ),
            'alerts' => $this->cleanAlerts(
                $response['alerts'] ?? []
            ),
            'recommendations' => $this->normalize(
                $response['recommendations'] ?? []
            ),
            'insights' => $this->normalize(
                $response['insights'] ?? []
            ),
            'generated_at' => now()->toDateTimeString(),
        ];
    }

    private function normalize($items): array
    {
        if (is_string($items)) {
            return [
                $items
            ];
        }

        if (!is_array($items)) {
            return [];
        }

        return collect($items)
            ->filter()
            ->values()
            ->toArray();
    }

    private function cleanSummary(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                return [
                    'title' =>
                        $item['title']
                            ?? 'Summary',
                    'message' =>
                        is_array($item['message'] ?? null)
                            ? (
                                $item['message']['message']
                                    ?? ''
                            )
                            : (
                                $item['message']
                                    ?? ''
                            )
                ];
            })
            ->values()
            ->toArray();
    }

    private function cleanAlerts(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                $message =
                    is_array($item['message'] ?? null)
                        ? $item['message']
                        : $item;

                return [
                    'type' =>
                        $item['type']
                            ?? $message['type']
                            ?? 'general',
                    'level' =>
                        $item['level']
                            ?? $message['level']
                            ?? 'low',
                    'title' =>
                        $item['title']
                            ?? $message['title']
                            ?? 'Alert',
                    'message' =>
                        $message['message']
                            ?? ''
                ];
            })
            ->values()
            ->toArray();
    }
}
