<div class="bg-white rounded-2xl shadow p-6">

    <h2 class="text-lg font-bold mb-5">
        Add Product
    </h2>

    <form method="POST" action="{{ route('sales.items.store', $sale) }}" class="space-y-5">

        @csrf

        {{-- Product --}}
        <div>

            <label class="block mb-2 font-medium">
                Product
            </label>

            <select name="product_id" required class="w-full rounded-xl border p-3">

                <option value="">
                    Select Product
                </option>

                @foreach ($products as $product)
                    <option value="{{ $product->id }}">

                        {{ $product->name }}
                        -
                        Stock:
                        {{ $product->stock_quantity }}

                    </option>
                @endforeach

            </select>

        </div>


        {{-- Quantity --}}

        <div>

            <label class="block mb-2 font-medium">
                Quantity
            </label>

            <input type="number" name="quantity" min="1" required class="w-full rounded-xl border p-3">

        </div>


        <button class="bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary/90">

            Add Item

        </button>

    </form>

</div>
