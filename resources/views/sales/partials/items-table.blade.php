<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="text-left p-4">
                    Product
                </th>

                <th class="text-left p-4">
                    Qty
                </th>

                <th class="text-left p-4">
                    Unit Price
                </th>

                <th class="text-left p-4">
                    Subtotal
                </th>

                <th class="text-center p-4">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($sale->items as $item)
                <tr class="border-t">

                    <td class="p-4">

                        {{ $item->product->name }}

                    </td>

                    <td class="p-4">

                        {{ $item->quantity }}

                    </td>

                    <td class="p-4">

                        {{ number_format($item->unit_price, 2) }}

                    </td>

                    <td class="p-4">

                        {{ number_format($item->subtotal, 2) }}

                    </td>

                    <td class="p-4 text-center">

                        <form method="POST" action="{{ route('sales.items.destroy', $item) }}">

                            @csrf

                            @method('DELETE')

                            <button class="text-red-600 hover:text-red-800">

                                Remove

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center py-6 text-gray-500">

                        No products added.

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

</div>
