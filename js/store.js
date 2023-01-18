document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        init () {
            fetch('/crest/api/cart.php')
                .then(res => res.json())
                .then(items => {
                    this.items = items
                })
                .catch(err => console.log(err))
        },
        itemsCount: 10,
        items: [],
        addItem (item) {

        },
        removeItem(item, qty) {

        },
        deleteItem(item) {

        }
    })
})