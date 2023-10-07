<form id="form-stock">
    <x-modal modalId="modal-stock" modalTitleClass="modal-title-stock">
        <div class="form-group" id="product">
            <label>Product</label>
            <select name="product" class="form-control w-100">
            </select>
        </div>
        <div class="form-group">
            <label>Qty</label>
            <input type="text" name="qty" class="form-control numericInput" autocomplete="off">
        </div>
        <div class="form-group">
            <label>Purchase Price</label>
            <input type="text" name="purchase_price" class="form-control currencyInput" autocomplete="off">
        </div>
    </x-modal>
</form>