const decrement = document.querySelector('.decrement')

const increment = document.querySelector('.increment')

const qty = document.querySelector('.qty-btn')





const cartCount = document.querySelector('.cart-count');

const wishCount = document.querySelector('.wish-count')
function load(){

    $.ajax({
        method: 'GET',
        url: '/load-cart-data',
        success: function (response) {
        cartCount.innerHTML = response.count
        }
    })

    $.ajax({
        method: 'GET',
        url: '/load-wish-data',
        success: function (response) {
        wishCount.innerHTML = response.count
        }
    })

}

load();

let value = qty.value;
decrement.addEventListener('click', () => {
    if (value > 1) {
        value--
    }
    qty.value = value;
})

increment.addEventListener('click', () => {
    if (value < 10) {
        value++
    }
    qty.value = value;
})




const prod_id = document.querySelector('.prod_id').value
const deleteCart = document.querySelectorAll('.delete-cart-item')
for (let i = 0; i < deleteCart.length; i++) {
    deleteCart[i].addEventListener('click', (e) => {
        console.log(prod_id)
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/delete-cart-item',
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // window.location.reload();
                swal("",response.status,"success");
            }
        })

    })
}


const changeQty = document.querySelectorAll('.changeQty')
console.log(changeQty);
for(let i =0;i<changeQty.length;i++){
    changeQty[i].addEventListener('click',(e)=>{

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: '/update-cart-qty',
            data: {
                'prod_id': prod_id,
                'prod_qty': qty.value
            },
            success: function (response) {
                // swal("",response.status,"success");
                window.location.reload();

            }
        })

    })
}






const addtoCartBtn = document.querySelector('.addtoCartBtn')
addtoCartBtn.addEventListener('click', () => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/add-to-cart',
        data: {
            'prod_id': prod_id,
            'qty': qty.value
        },
        success: function (response) {
            swal(response.status);
            load()
        }
    })
})



const addToWishList = document.querySelector('.addToWishList');

addToWishList.addEventListener('click',(e)=>{
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/add-to-wishlist',
        data: {
            'prod_id': prod_id,
        },
        success: function (response) {
            swal(response.status);
            load()
        }
    })
})







const deleteWish = document.querySelector('.remove-wishlist')

deleteWish.addEventListener('click',(e)=>{
    e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/delete-wish-item',
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // window.location.reload();
                swal("",response.status,"success");
            }
        })

})







    // let postObj = {
    //    'prod_id':prod_id,
    //    'qty'    :qty.value
    // }

    // document.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': document.getElementsByName('meta[name="csrf-token"]').attributes('content')
    //     }
    // })
    // let endPoint = '/add-to-cart'
    // fetch(endPoint,{
    //   method:"POST",
    // //   headers: {'X-CSRF-TOKEN':  },
    //   body: JSON.stringify(postObj),
    // }).then(res => {
    //   console.log("Request complete! response:", res);
    // //   window.location.reload()
    // }).catch((err)=> console.log(err))

