<?php

namespace App\Reports\Contracts;

interface ReportProviderInterface
{
    /**
     * Get the formatted data for the report.
     *
     * @return array{
     *     title: string,
     *     summary: array,
     *     columns: array,
     *     rows: array
     * }
     */
    public function getData(): array;
}
