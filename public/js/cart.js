$(document).ready(function () {
    $('.cart-icon-container').click(() => {
        $('.cart-modal-container').addClass("over")
        if($('.cart-modal').css('display') == 'none') {
            $('.cart-modal-container').removeClass("over")
        }
        else {
            $('.cart-modal-container').addClass("over")
        }
    })

    $('.cart-modal').click((event) => {
        event.stopPropagation()
    })

    $('.background').click(() => {
        $('.cart-modal-container').removeClass("over")
    })
})
