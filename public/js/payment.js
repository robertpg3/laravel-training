$(document).ready(function () {
    var stripe = Stripe('pk_test_51IXnY6JqcnBPjORHB1VJAJEjecPqSVaoMvjhkTBIik6UedBN7Adesy7d918UonDq2x2q2lxQNE57TaKtBXp8FLSk00blATrvT8')
    var elements = stripe.elements()
    var cardElement = elements.create('card')

    if($('#card-element').length) {
        cardElement.mount('#card-element')

        var cardholderName = document.getElementById('cardholder-name')
        var cardButton = document.getElementById('card-button')
        var clientSecret = cardButton.dataset.secret

        //console.log(cardholderName.dataset.secret)
        cardButton.addEventListener('click', function(ev) {
            stripe.handleCardPayment(
                clientSecret, cardElement, {
                    payment_method_data: {
                        billing_details: { name: cardholderName.value, email: cardholderName.dataset.secret },
                    },
                }
            ).then(function (result) {
                if(result.error) {
                    window.location.href = '/error'
                } else {
                    window.location.href = '/success'
                }
            })
        })
    }
})







