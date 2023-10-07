<form id="form-store" enctype="multipart/form-data">
    <x-modal>
        <input type="hidden" name="id">
        <div class="from-group" id="photo">

        </div>
        <div class="form-group">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control">
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control">
                <option value="">--- Choice ---</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Purchase Price</label>
            <input type="text" name="purchase_price" class="form-control currencyInput" maxlength="20">
        </div>
        <div class="form-group">
            <label>Selling Price</label>
            <input type="text" name="selling_price" class="form-control currencyInput" maxlength="20">
        </div>

    </x-modal>
</form>
