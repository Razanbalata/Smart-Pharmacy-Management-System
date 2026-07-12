@if(isset($summary) && !empty($summary))
<div class="summary-container">
    @foreach($summary as $label => $value)
        <div class="summary-box">
            <h3>{{ $label }}</h3>
            <p>{{ $value }}</p>
        </div>
    @endforeach
</div>
@endif
