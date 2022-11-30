<x-layout class="pb-20" :title="$title">
    <x-card class="flex-col !items-start">
        <div class="font-bold text-2xl pb-2 w-full flex flex-col lg:flex-row justify-between">
            <div class="flex flex-col justify-center gap-2 py-2 lg:py-0">
                <div class="flex items-center gap-2">
                    <p>Order # {{ $order->id }}</p>
                    @if ($order->payment == 'Paid')
                        <span class="px-2 py-1 border border-current text-lime-500 rounded-lg text-sm">
                            <i class="fa-duotone fa-badge-check fa-swap-opacity"></i> Paid
                        </span>
                    @else
                        <span class="px-2 py-1 border border-current text-gray-400 rounded-lg text-sm">
                            <i class="fa-duotone fa-hourglass-half"></i> Unpaid
                        </span>
                    @endif
                </div>
                @php
                    $table_no = explode(',', $order->table);
                @endphp
                <p class="text-lg py-2 flex flex-wrap gap-2 items-center">
                    Tables:
                    @foreach ($table_no as $table)
                        @foreach ($tables as $tab)
                            @if ($table == $tab['id'])
                                <span class="p-2 rounded-full border w-max border-amber-500 text-xs">{{ $tab['name'] }}
                                </span>
                            @endif
                        @endforeach
                    @endforeach
                </p>

            </div>
            <div class="flex gap-2 text-sm items-center font-thin self-start lg:mt-2">{{-- Index --}}
                <div class="flex gap-2 items-center">
                    <p class="font-bold">Item Status: </p>
                    <div class="w-max px-1 py-2 rounded-full bg-amber-500 flex-1 inline items-center"></div>
                    <p>Pending Item</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-max px-1 py-2 rounded-full bg-blue-500 flex-1 inline items-center"></div>
                    <p>Cooking</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-max px-1 py-2 rounded-full bg-green-500 flex-1 inline items-center"></div>
                    <p>
                        Cooked
                    </p>
                </div>
            </div>
        </div>
        <table class="table-auto text-xs w-full">
            <thead class="font-bold lg:text-sm">
                <tr class="bg-gray-400 w-full">
                    <td class="w-6/12 pl-2 broder-r-white border-r py-2">Items</td>
                    <td class="w-1/12 broder-r-white border-r text-center py-2 px-2">Qty.</td>
                    <td class="w-3/12 text-center py-2 broder-r-white border-r">Price</td>
                    <td class="w-1/12 text-center py-2">Amount</td>
                </tr>
            </thead>
            <tbody class="lg:text-lg">
                @foreach ($order->orderItems as $orderItem)
                    @if ($order->id == $orderItem->order_id)
                        @php
                            $amounts[] = $orderItem['qty'] * $orderItem->item->price;
                            
                        @endphp
                        <tr
                            class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300  @if ($orderItem->status == 'done') !bg-lime-300 @elseif($orderItem->status == 'cooking') animate-pulse @endif">
                            <td class="pl-2 py-2">
                                <div
                                    class="px-1 rounded-full flex-1 inline items-center w-max mr-2 @if ($orderItem->status == 'pending') bg-yellow-500 @elseif($orderItem->status == 'cooking')bg-blue-500 @elseif($orderItem->status == 'done')bg-green-500 @endif">
                                </div>
                                {{ $orderItem->item->name }}
                            </td>
                            <td
                                class="text-center @if (isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) flex justify-center items-center h-full pl-2 py-2 @endif">
                                <span
                                    class="@if (isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) hidden @else flex flex-1 gap-2 justify-center @endif"
                                    id="span_{{ $orderItem->id }}">{{ $orderItem->qty }}
                                    @if ($orderItem->status == 'pending')
                                        <i class="fa-duotone fa-edit vm-theme hover:cursor-pointer"
                                            id="icon_{{ $orderItem->id }}"></i>
                                    @endif
                                </span>
                                <form action="/orders/{{ $orderItem->id }}/additems/{{ $orderItem->id }}" method="post"
                                    class="@if (isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) flex justify-center items-center gap-2 w-max @else hidden @endif"
                                    id="form_{{ $orderItem->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="qty" id="qty" value="{{ $orderItem->qty }}"
                                        class="w-10 bg-gray-300 animate-pulse text-center">
                                    <button type="submit"><i class="fa-duotone fa-check vm-theme"></i></button>
                                </form>
                            </td>
                            <td class="text-center">
                                {{ 'Rs. ' . $orderItem->item->price }}
                            </td>
                            <td class="text-left px-2">
                                <div class="flex justify-between items-center">
                                    <p>{{ 'Rs. ' . $orderItem->qty * $orderItem->item->price }}</p>
                                    @if ($orderItem->status == 'pending')
                                        <form method="POST"
                                            action="/orderitems/{{ $order->id }}/{{ $orderItem->id }}/delete">
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete"
                                                onclick="return confirm('Are you sure you want to delete this record?')"
                                                type="submit"> <i
                                                    class="fa-solid fa-trash smooth hover:text-rose-600"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <script>
                            $("#icon_{{ $orderItem->id }}").click(function() {
                                location.replace('?edit={{ $orderItem->id }}');
                            });
                        </script>
                    @endif
                @endforeach

                @if (isset($amounts))
                    @php
                        $subtotal = array_sum($amounts);
                    @endphp
                    <tr class="bg-gray-200 text-lg">
                        <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                            Sub Total <br>
                        </td>
                        <td class="flex px-2 w-max items-center py-2">
                            Rs. {{ $subtotal }}
                        </td>
                    </tr>
                    @if ($order->discount == null)
                        <tr class="bg-gray-200 text-lg">
                            <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                                Discount Type <br>
                            </td>
                            <td class="flex px-2 w-max items-center py-2">
                                @if ($order->discount == null)
                                    <select name="discount_type" id="discount_type"
                                        class="w-20 rounded-lg outline-none p-2 text-sm">
                                        <option value="">-</option>
                                        <option value="10%">10%</option>
                                        <option value="15%">15%</option>
                                        <option value="20%">20%</option>
                                        <option value="bulk">Bulk</option>
                                    </select>
                                @else
                                    {{ $order->discount_type }}
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr class="bg-gray-200" id="discountAmt">
                        <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                            Discount Amount <br>
                            @error('discount')
                                <p class="text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </td>
                        <td class="flex px-2 w-max items-center py-2">
                            @if ($order->discount == null)
                                <form action="/invoices/{{ $order->id }}/discount/update" method="POST">
                                    @csrf
                                    <input type="number" name="discount" id="discount"
                                        class="w-20 rounded-lg outline-none p-2 text-sm" step=any>
                                    <button type="submit"><i class="fa-duotone fa-up vm-theme"></i></button>
                                </form>
                            @else
                                Rs. {{ $order->discount }}
                            @endif
                        </td>
                    </tr>
                    @if (isset($order->discount))
                        @php
                            $discountAmount = $order->discount;
                            $totalAfterDiscount = $subtotal - $discountAmount;
                        @endphp
                    @endif
                    <tr class="bg-gray-200 text-lg">
                        <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                            VAT(13%) <br>
                        </td>
                        <td class="flex px-2 w-max items-center py-2">
                            @php
                                if (isset($totalAfterDiscount)) {
                                    $vat = 0.13 * $totalAfterDiscount;
                                    $grandTotal = $totalAfterDiscount + $vat;
                                } else {
                                    $vat = 0.13 * $subtotal;
                                    $grandTotal = $subtotal + $vat;
                                }
                            @endphp
                            Rs. {{ number_format($vat, 2) }}
                        </td>
                    </tr>
                    <tr class="bg-gray-400 font-bold text-xl">
                        <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                            Grand Total
                        </td>
                        <td class="flex px-2 w-max items-center py-2 font-medium text-lg self-center">
                            Rs. {{ number_format($grandTotal, 2) }}
                        </td>
                    </tr>
                @endif
                <script>
                    $(document).ready(function() {
                        @if (isset($order->discount))
                            $('#discountAmt').show();
                        @else
                            $('#discountAmt').hide();
                        @endif
                    })
                    $('#discount_type').on('change', function() {
                        const subtotal = {{ isset($subtotal) ? $subtotal : '' }};

                        if ($('#discount_type').val() === 'bulk') {
                            $("#discountAmt").show();
                        }
                        if ($('#discount_type').val() === '10%') {
                            var discount = subtotal * 0.1;
                            var discountAmt = (subtotal - discount);
                            var gtotal = discountAmt + (0.13 * discountAmt);
                            $("#discountAmt").show();
                            $("#discount").val(discount);
                        }
                        if ($('#discount_type').val() === '15%') {
                            var discount = subtotal * 0.15;
                            var discountAmt = (subtotal - discount);
                            var gtotal = discountAmt + (0.13 * discountAmt);
                            $("#discountAmt").show();
                            $("#discount").val(discount);
                        }
                        if ($('#discount_type').val() === '20%') {
                            var discount = subtotal * 0.2;
                            var discountAmt = (subtotal - discount);
                            var gtotal = discountAmt + (0.13 * discountAmt);
                            $("#discountAmt").show();
                            $("#discount").val(discount);
                        }
                        if ($('#discount_type').val() === 'bulk') {
                            $("#discountAmt").show();
                            $("#discount").val('');
                        }
                    })
                </script>
            </tbody>
        </table>
        @if (isset($amounts))
            <div class="flex justify-between items-center w-full mt-4">
                @if ($order->customer == null)
                    <form action="/invoices/{{ $order->id }}/customer/update" method="POST" id="customer"
                        class="flex items-center gap-2">
                        @csrf
                        <select name="customer"
                            class="p-2 rounded-lg bg-gray-600/10 text-gray-800 border broder border-current outline-none">
                            <option value="" hidden>Please choose a customer.</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" form="customer"
                            class="!py-1 btn-primary !text-gray-800 hover:text-gray-100">Update</button>
                    </form>
                @else
                    <p class="w-full flex flex-wrap items-center gap-2">Customer:
                        <span class="font-bold text-xl text-amber-600">
                            @foreach ($customers as $customer)
                                @if ($customer->id == $order->customer)
                                    {{ $customer->name }} 
                                @endif
                            @endforeach
                        </span>
                    </p>
                @endif
                <div class="flex lg:justify-end justify-center mt-4 md:!mt-0 gap-4 w-full">
                    @if ($order->payment != 'Paid')
                        <a href="/orders/{{ $order->id }}/paid"
                            class="btn-secondary hover:scale-105 !text-green-600">Paid</a>
                    @endif
                    @if ($order->customer != null)
                        <a href="/orders/{{ $order->id }}/complete"
                            class="btn-secondary hover:scale-105" title="Complete Order">Complete</a>
                    @endif
                </div>
            </div>
            @error('customer')
                <p class="text-xs text-rose-600">{{ $message }}</p>
            @enderror

        @endif
    </x-card>

    {{-- Ajax Starting --}}
    <script class="text/javascript"></script>
</x-layout>
