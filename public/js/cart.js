$(document).ready(function () {
    console.log('READY')

    $('.cart-icon-container').click(() => {
        console.log('HERE')
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



