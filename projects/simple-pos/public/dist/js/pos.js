let audioAddCart = new Audio(BASE_URL + '/dist/audio/add_to_cart.mp3')
let audioRemoveCart = new Audio(BASE_URL + '/dist/audio/remove_cart_item.mp3')
document.addEventListener('alpine:init', async () => {
    Alpine.store('pos', {
        products: [],
        product: {},
        modal: false,
        emptyProducts: false,
        cart: [],
        search: '',
        category: '',
        loading: false,
        subTotal: 0,
        total: 0,
        discount: 0,
        customer: '',
        paid: '',
        charge: 0,
        // invoiceCode: '',
        dateTime: '',
        async init() {
            this.fetchProduct(),
                this.dateTimeTick()
        },
        async fetchProduct() {
            let url = BASE_URL + '/admin/api/product' + '?q=' + this.search + '&category=' +
                this.category + '&have_stock=1'
            const response = await axios.get(url)
                .then(response => {
                    this.loading = false
                    this.products = response.data

                    if (this.products.length == 0) {
                        this.emptyProducts = true
                    } else {
                        this.emptyProducts = false
                    }
                })

            this.calculate()
        },
        async addToCart(product) {
            audioAddCart.play()
            let cartData = {
                id: product.id,
                name: product.name,
                price: product.selling_price,
                qty: 1,
                image: imageUrl(product.photo),
                purchase_price: product.avarage_purchase_price,
            }

            // check if product already in cart
            let index = this.cart.findIndex(item => item.id == product.id)
            if (index > -1) {
                this.cart[index].qty++
            } else {
                this.cart.push(cartData)
            }

            this.calculate()
        },
        async changeQty(id, qty) {
            let index = this.cart.findIndex(item => item.id == id)
            if (index > -1) {
                this.cart[index].qty += qty
                if (this.cart[index].qty < 1) {
                    this.cart[index].qty = 1
                }
            }

            this.calculate()
        },
        async deleteItem(id) {
            audioRemoveCart.play()
            let index = this.cart.findIndex(item => item.id == id)
            if (index > -1) {
                this.cart.splice(index, 1)
            }
            this.calculate()
        },
        async subTotalCount() {
            let subTotal = 0
            this.cart.forEach(item => {
                console.log
                // remove dot
                subTotal += removeComa(item.price) * item.qty
            });

            this.subTotal = subTotal
        },
        async calculate() {
            this.subTotalCount()
            let discount = this.discount / 100 * this.subTotal
            this.total = this.subTotal - discount
            let paid = 0;

            // remove dot and Rp
            paid = removeComa(this.paid)

            this.charge = (paid - this.total) < 0 ? 0 : paid - this.total
        },
        async checkout() {
            let paid = this.paid.replace(/[^,\d]/g, '').toString()
            if (this.cart.length == 0) {
                errorNotif('Cart is empty')
                return
            }

            if (paid < this.total) {
                errorNotif('Paid is less than total')
                return
            }

            let data = {
                cart: this.cart,
                discount: this.discount,
                total: this.total,
                customer: this.customer,
                paid: this.paid.replace(/[^,\d]/g, '').toString()
            }

            const response = await axios.post(BASE_URL + '/admin/order', data)
                .then(response => {
                    successNotif(response.data.message)
                    setTimeout(() => {
                        window.location.href = response.data.redirect
                    }, 1000);

                    // reset all data form
                    this.cart = []
                    this.discount = 0
                    this.customer = ''
                    this.paid = ''
                    this.charge = 0
                    this.calculate()

                    // select 2 reset
                    $('#customer').val(null).trigger('change');
                })
                .catch(error => {
                    errorNotif(error.message)
                })
        },
        async changePrice(id, price) {
            let index = this.cart.findIndex(item => item.id == id)
            // remove dot
            if (index > -1) {
                this.cart[index].price = price
            }

            this.calculate()
        },
        async dateTimeTick() {
            let date = new Date()
            let day = date.getDate()
            let month = date.getMonth() + 1
            let year = date.getFullYear()
            let hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours()
            let minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()
            let second = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds()

            this.dateTime = day + '/' + month + '/' + year + ' ' + hour + ':' + minute + ':' +
                second
        }
    });
})

// remove koma
function removeComa(value) {
    // 200,000,000 to 200000000
    return parseFloat(value.toString().replace(/,/g, ''))
}

