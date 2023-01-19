const cartApiEndpoint = `/crest/api/cart`;

document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        init () {
            this.fetchItems()
        },
        itemsCount: 10,
        items: [],
        fetchItems () {
            fetch(cartApiEndpoint)
                .then(res => res.json())
                .then(items => {
                    this.items = items
                })
                .catch(err => console.log(err))
        },
        inCart (item) {
            return this.items.find(_item => _item.id === item.id)
        },
        addItem (item) {
            fetch(cartApiEndpoint, {
                headers: {
                    'Content-Type': 'application/json'
                },
                method: 'POST',
                body: JSON.stringify({
                    product_id: item.id
                })
            })
            .then(res => res.json())
            .then(data => {
                this.fetchItems()
                swal({
                    title: "Added to cart",
                    text: "Do you want to proceed to checkout?",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = "checkout"
                        } else {}
                    });
            })
            .catch(err => console.log(err))
        },
        removeItem(item, qty) {
        },
        deleteItem(item) {
        }
    })
})