@if(isset($columns) && isset($rows))
<table>
    <thead>
        <tr>
            @foreach($columns as $key => $label)
                <th>{{ $label }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse($rows as $row)
            <tr>
                @foreach($columns as $key => $label)
                    <td>{{ $row[$key] ?? '' }}</td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($columns) }}" style="text-align: center;">No records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endif
