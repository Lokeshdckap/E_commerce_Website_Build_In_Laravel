
const razorpay_btn = document.querySelector('.razorpay_btn')
console.log(razorpay_btn);
const firstname = document.querySelector('.firstName').value
const lname = document.querySelector('.lastName').value
const email = document.querySelector('.email').value
const phone = document.querySelector('.phone').value
const address1 = document.querySelector('.address1').value
const address2 = document.querySelector('.address2').value
const city = document.querySelector('.city').value
const state = document.querySelector('.state').value
const country = document.querySelector('.country').value
const pincode = document.querySelector('.pincode').value

let fname_error;
let lname_error;
let email_error;
let phone_error;
let address1_error;
let address2_error;
let city_error;
let state_error;
let country_error;
let pincode_error;
razorpay_btn.addEventListener('click', () => {
    if (firstname == "") {
        fname_error = 'This field is required'
        document.querySelector('#fname_error').innerText = fname_error;


    }
    // else if (lname == "") {
    //     lname_error = 'This field is required'
    //     document.querySelector('#lname_error').innerText = lname_error;
    // }
    // else if (email == "") {
    //     email_error = 'This field is required'
    //     document.querySelector('#email_error').innerText = email_error;
    // }

    // else if (phone == "") {
    //     phone_error = 'This field is required'
    //     document.querySelector('#phone_error').innerText = phone_error;
    // }

    // else if (address1 == "") {
    //     address1_error = 'This field is required'
    //     document.querySelector('#address1_error').innerText = address1_error;
    // }
    // else if (address2 == "") {
    //     address2_error = 'This field is required'
    //     document.querySelector('#address2_error').innerText = address2_error;
    // }

    // else if (city == "") {
    //     city_error = 'This field is required'
    //     document.querySelector('#city_error').innerText = city_error;
    // }

    // else if (state == "") {
    //     state_error = 'This field is required'
    //     document.querySelector('#state_error').innerText = state_error;
    // }

    // else if (country == "") {
    //     country_error = 'This field is required'
    //     document.querySelector('#country_error').innerText = country_error;
    // }

    // else if (pincode == "") {
    //     pincode_error = 'This field is required'
    //     document.querySelector('#pincode_error').innerText = pincode_error;
    // }

    // else {
    //     document.querySelector('#fname_error').innerText = ""
    // }

    // if (fname_error != "" || lname_error != "" || email_error != "" || phone_error != "" || address1_error != "" || address2_error != "" || city_error != "" || state_error != "" || country_error != "" || pincode_error != "") {
    //     // return false;
    // }

    else {

    let data = {
        'firstname': firstname,
        'lname': lname,
        'email': email,
        'phone': phone,
        'address1': address1,
        'address2': address2,
        'city': city,
        'state': state,
        'country': country,
        'pincode': pincode
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: '/proceed-to-pay',
        data: data,
        success: function (response) {
            // alert(response.address1);
            var options = {
                "key": "rzp_test_j7xuuDCWFFTmBn", // Enter the Key ID generated from the Dashboard
                "amount":response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": response.firstname+""+response.lname, //your business name
                "description": "Thank you for choosing us !",
                "image": "https://example.com/your_logo",
                // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (responsea){
                    swal(responsea.razorpay_payment_id)
                    $.ajax({
                        method: 'POST',
                        url: '/place-order',
                        data: {
                            'fname':response.firstname,
                            'lname':response.lname,
                            'email':response.email,
                            'phone':response.phone,
                            'address_1':response.address1,
                            'address_2':response.address2,
                            'city':response.city,
                            'state':response.state,
                            'country':response.country,
                            'pincode':response.pincode,
                            'payment_mode':"Paid by Razorpay",
                            'payment_id':responsea.razorpay_payment_id,
                        },
                        success: function (responseb) {
                            swal(responseb.status)
                            .then((value) => {
                               window.location.href = '/my-orders'
                              });
                        }
                    })
                    // alert(response.razorpay_payment_id);
                    // alert(response.razorpay_order_id);
                    // alert(response.razorpay_signature)
                },
                "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                    "name": response.firstname+""+response.lname, //your customer's name
                    "email": response.email,
                    "contact": response.phone//Provide the customer's phone number for better conversion rates
                },
                "notes": {
                    "address": "E-commerce Corporate Office"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            // rzp1.on('payment.failed', function (response){
                    // alert(response.error.code);
                    // alert(response.error.description);
                    // alert(response.error.source);
                    // alert(response.error.step);
                    // alert(response.error.reason);
                    // alert(response.error.metadata.order_id);
                    // alert(response.error.metadata.payment_id);
            // });
            // document.getElementById('rzp-button1').onclick = function(e){
                // e.preventDefault();
            // }

        }
    })
    }
})
