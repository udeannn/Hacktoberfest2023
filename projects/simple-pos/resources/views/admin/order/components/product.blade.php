<span id="items">
    <div class="row">

        <template x-if="$store.pos.emptyProducts">
            {{-- center & middle --}}
            <div class="w-100 pt-5 d-flex flex-column justify-content-center align-items-center my-auto mx-auto">
                <div>
                    <img src="{{ asset('dist/img/undraw_not_found_re_bh2e.svg') }}" width="200">
                </div>
                <h4 class="mt-5">Product Not Found</h4>
            </div>

        </template>

        <template x-for="product in $store.pos.products" :key="product.id">
            <div class="col-md-2 col-6">
                <figure class="card card-product d-flex align-items-stretch" @click="$store.pos.addToCart(product)">
                    <span class="badge-new" x-text="numeric(product.stock)"></span>
                    <div class="img-wrap">
                        <img :src="imageUrl(product.photo)">
                    </div>
                    <figcaption class="info-wrap">
                        <a href="#" class="product-title"
                            x-text="product.name.length > 12 ? product.name.substring(0,12) + '...' : product.name "></a>
                        <div class="action-wrap">
                            <div class="price-wrap">
                                <span class="price-new" x-text="rupiah(product.selling_price)"></span>
                            </div> <!-- price-wrap.// -->
                        </div> <!-- action-wrap -->
                    </figcaption>
                </figure> <!-- card // -->
            </div> <!-- col // -->
        </template>

    </div> <!-- row.// -->
</span>
