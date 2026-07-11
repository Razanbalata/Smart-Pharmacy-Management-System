<?php

namespace App\Services\AI\Chat;

class IntentDetector
{
    public function detect(string $message): array
    {
        $message = strtolower($message);

        /*
         * |--------------------------------------------------------------------------
         * | Products / Inventory
         * |--------------------------------------------------------------------------
         */

        if ($this->contains($message, [
            'product',
            'products',
            'medicine',
            'drug',
            'دواء',
            'منتج',
            'الأصناف',
            'المخزون',
            'stock',
            'inventory',
            'ناقص',
            'ينقص'
        ])) {
            return [
                'module' => 'products',
                'contexts' => [
                    'products',
                    'stock'
                ]
            ];
        }

        /*
         * |--------------------------------------------------------------------------
         * | Sales
         * |--------------------------------------------------------------------------
         */

        if ($this->contains($message, [
            'sales',
            'sale',
            'revenue',
            'profit',
            'بيع',
            'مبيعات',
            'الأرباح'
        ])) {
            return [
                'module' => 'sales',
                'contexts' => [
                    'sales',
                    'products'
                ]
            ];
        }

        /*
         * |--------------------------------------------------------------------------
         * | Purchases
         * |--------------------------------------------------------------------------
         */

        if ($this->contains($message, [
            'purchase',
            'purchases',
            'supplier',
            'شراء',
            'مورد',
            'الموردين'
        ])) {
            return [
                'module' => 'purchases',
                'contexts' => [
                    'purchases',
                    'suppliers'
                ]
            ];
        }

        /*
         * |--------------------------------------------------------------------------
         * | Stock Movement
         * |--------------------------------------------------------------------------
         */

        if ($this->contains($message, [
            'movement',
            'movements',
            'adjustment',
            'expired',
            'damaged',
            'تالف',
            'منتهي',
            'حركة'
        ])) {
            return [
                'module' => 'stock',
                'contexts' => [
                    'stock'
                ]
            ];
        }

        /*
         * |--------------------------------------------------------------------------
         * | Dashboard
         * |--------------------------------------------------------------------------
         */

        if ($this->contains($message, [
            'overview',
            'summary',
            'status',
            'dashboard',
            'الوضع',
            'التقرير العام'
        ])) {
            return [
                'module' => 'dashboard',
                'contexts' => [
                    'dashboard'
                ]
            ];
        }

        /*
         * |--------------------------------------------------------------------------
         * | Default
         * |--------------------------------------------------------------------------
         */

        return [
            'module' => 'general',
            'contexts' => []
        ];
    }

    private function contains(
        string $message,
        array $keywords
    ): bool {
        foreach ($keywords as $keyword) {
            if (str_contains(
                $message,
                strtolower($keyword)
            )) {
                return true;
            }
        }

        return false;
    }
}
