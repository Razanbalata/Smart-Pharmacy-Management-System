<?php

namespace App\Services\AI;

class AIResponseFormatter
{
    public function format(array $response, array $context): array
    {
        return [
            'status' => [
                'level' => $context['status']['level'] ?? 'info',
                'label' => $context['status']['label'] ?? 'AI Analysis Completed'
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
            'generated_at'=>now()->toDateTimeString(),
        ];
    }

    private function normalize($items): array
    {
        if (is_string($items)) {
            return [
                $items
            ];
        }

        if (is_array($items)) {
            return $items;
        }

        return [];
    }

    private function cleanSummary(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                if (is_array($item['message'] ?? null)) {
                    return [
                        'title' =>
                            $item['message']['title']
                                ?? $item['title']
                                ?? 'Summary',
                        'message' =>
                            $item['message']['message']
                                ?? ''
                    ];
                }

                return $item;
            })
            ->toArray();
    }

    private function cleanAlerts(array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                if (is_array($item['message'] ?? null)) {
                    return [
                        'type' =>
                            $item['message']['type'] ?? 'general',
                        'level' =>
                            $item['message']['level'] ?? 'low',
                        'title' =>
                            $item['message']['title'] ?? 'Alert',
                        'message' =>
                            $item['message']['message'] ?? ''
                    ];
                }

                return $item;
            })
            ->toArray();
    }
}
