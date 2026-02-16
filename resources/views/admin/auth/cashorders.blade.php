<html>
<body>

<!-- Cash Order Modal -->
<div id="cashOrderModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:999;">
  <div style="background:white; width:600px; max-width:90%; margin:60px auto; padding:25px; border-radius:10px; position:relative;">
    <h3 style="margin-top: 0;">➕ Add Cash Order</h3>

    <button id="closeModalBtn" style="position:absolute; top:10px; right:10px; background:red; color:white; border:none; border-radius:50%; width:30px; height:30px; font-weight:bold; cursor:pointer;">×</button>

    <form action="{{ route('admin.orders.cash-order-multi') }}" method="POST" onsubmit="return prepareModalItems();">
      @csrf

      <div style="display: flex; gap: 10px; margin-bottom: 15px;">
        <select id="modalMenuItemSelect" style="flex: 1;">
          <option value="" data-price="0">-- Select Item --</option>
          @foreach($menuItems as $item)
            <option value="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}">
              {{ $item->name }} - Rs.{{ $item->price }}
            </option>
          @endforeach
        </select>

        <input type="number" id="modalQuantityInput" placeholder="Qty" min="1" style="width: 80px;" />

        <button type="button" id="modalAddItemBtn" style="background-color: #28a745; color: white; padding: 6px 12px; border: none; border-radius: 4px;">
          ➕ Add
        </button>
      </div>

      <!-- Table -->
      <table id="modalItemsTable" style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <thead>
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      <input type="hidden" name="items_json" id="modalItemsJsonInput" />
      <input type="hidden" name="payment_status" value="cash" />
      <button type="submit" style="background-color:#007bff; color:white; padding:8px 16px; border:none; border-radius:5px;">
        Submit Order
      </button>
    </form>
  </div>
</div>

</body>
</html>