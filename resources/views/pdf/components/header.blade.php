<div class="header">
    <h1>{{ config('app.name', 'PharmaSmart') }}</h1>
    <p>{{ $title ?? 'Report' }}</p>
    <p>Generated on: {{ now()->format('Y-m-d H:i') }}</p>
</div>
