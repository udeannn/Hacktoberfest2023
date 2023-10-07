<div class="card">
    <template x-if="$store.pos.cart.length == 0">
        {{-- center & middle --}}
        <div class="w-100 pt-5 d-flex flex-column justify-content-center align-items-center my-auto mx-auto">
            <div>
                <img src="{{ asset('dist/img/undraw_empty_cart_co35.svg') }}" width="200">
            </div>
            <h4 class="mt-5">Cart is Empty</h4>
        </div>

    </template>
    <template x-if="$store.pos.cart.length > 0">
        <span id="cart">
            <div class="table-responsive">
                <table class="table table-hover shopping-cart-wrap">
                    <thead class="text-muted">
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col" width="120">Qty</th>
                            <th scope="col" width="120">Price</th>
                            <th scope="col" class="text-right" width="200">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="item in $store.pos.cart" :key="item.id">
                            <tr>
                                <td>
                                    <figure class="media">
                                        <div class="img-wrap"><img :src="item.image" class="img-thumbnail img-xs">
                                        </div>
                                        <figcaption class="media-body">
                                            <h6 class="title" x-text="item.name"></h6>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td class="text-center">
                                    <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group"
                                        aria-label="...">
                                        <button type="button" class="m-btn btn btn-danger"
                                            @click="$store.pos.changeQty(item.id, -1)"><i
                                                class="fa fa-minus"></i></button>
                                        <button type="button" class="m-btn btn btn-default" disabled
                                            x-text="item.qty"></button>
                                        <button type="button" class="m-btn btn btn-success"
                                            @click="$store.pos.changeQty(item.id, 1)"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="price-wrap">
                                        {{-- <p x-text=" rupiah(item.price)">
                                        </p> --}}
                                        <input class="form-control price-item" type="text"
                                            x-bind:value="item.price" style="width: 100%"
                                            x-mask:dynamic="$money($input)"
                                            @keyup="$store.pos.changePrice(item.id, $event.target.value)">
                                    </div> <!-- price-wrap .// -->
                                </td>
                                <td class=" text-right">
                                    <button class="btn btn-outline-danger" @click="$store.pos.deleteItem(item.id)">
                                        <i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </span>
    </template>
</div> <!-- card.// -->
