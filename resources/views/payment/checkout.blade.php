<!-- resources/views/payment/checkout.blade.php -->

<html>
<body>

</body>
</html>

<html>

    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>payment process</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <style>
            ::-webkit-scrollbar {
                width: 8px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            body {
                height: 100vh;
                justify-content: center;
                align-items: center;
                display: flex;
                background-color: #eee
            }

            .launch {
                height: 50px
            }

            .close {
                font-size: 21px;
                cursor: pointer
            }

            .modal-body {
                height: 450px
            }

            .nav-tabs {
                border: none !important
            }

            .nav-tabs .nav-link.active {
                color: #495057;
                background-color: #fff;
                border-color: #ffffff #ffffff #fff;
                border-top: 3px solid blue !important
            }

            .nav-tabs .nav-link {
                margin-bottom: -1px;
                border: 1px solid transparent;
                border-top-left-radius: 0rem;
                border-top-right-radius: 0rem;
                border-top: 3px solid #eee;
                font-size: 20px
            }

            .nav-tabs .nav-link:hover {
                border-color: #e9ecef #ffffff #ffffff
            }

            .nav-tabs {
                display: table !important;
                width: 100%
            }

            .nav-item {
                display: table-cell
            }

            .form-control {
                border-bottom: 1px solid #eee !important;
                border: none;
                font-weight: 600
            }

            .form-control:focus {
                color: #495057;
                background-color: #fff;
                border-color: #8bbafe;
                outline: 0;
                box-shadow: none
            }

            .inputbox {
                position: relative;
                margin-bottom: 20px;
                width: 100%
            }

            .inputbox span {
                position: absolute;
                top: 7px;
                left: 11px;
                transition: 0.5s
            }

            .inputbox i {
                position: absolute;
                top: 13px;
                right: 8px;
                transition: 0.5s;
                color: #3F51B5
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0
            }

            .inputbox input:focus~span {
                transform: translateX(-0px) translateY(-15px);
                font-size: 12px
            }

            .inputbox input:valid~span {
                transform: translateX(-0px) translateY(-15px);
                font-size: 12px
            }

            .pay button {
                height: 47px;
                border-radius: 37px
            }
        </style>
    </head>

    <body className='snippet-body'>

        <div class="modal-dialog" style="width: 450px;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-right">

                    </div>
                    <div class="tabs mt-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">

                                <img src="https://guruniwasa2024.lk/inc/images/payhere.png" width="100%">

                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="visa" role="tabpanel" aria-labelledby="visa-tab">
                                <div class="mt-4 mx-4">
                                    <div class="text-center">
                                        
                                    </div>
                                    <div class="form mt-3">
                                        <!--<form method="post" action="https://sandbox.payhere.lk/pay/checkout">-->
                                        

                                        <form method="post" id="paymentForm" action="https://sandbox.payhere.lk/pay/checkout">   
                                            @csrf
                                            @foreach($data as $key => $value)
                                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endforeach
                                          
                                        </form>
                                        <div id="loadingSpinner" style="display: block;text-align: center;font-size: 20px;">
                                            <!-- Add your loading animation or text here -->
                                            Connecting Paymentgetway...
                                            <br/>
                                            waiting for <span id="countdown">5</span> sec
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
                <script type='text/javascript' src='#'></script>
                <script type='text/javascript' src='#'></script>
                <script type='text/javascript' src='#'></script>
                <script type='text/javascript'>
                    #
                </script>
                <script type='text/javascript'>
                    var myLink = document.querySelector('a[href="#"]');
                    myLink.addEventListener('click', function(e) {
                        e.preventDefault();
                    });
                </script>
                <script>
                    document.onkeydown = function(e) {
                        if (event.keyCode == 123) {
                            return false;
                        }
                        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'X'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'Y'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'Z'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'V'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.keyCode == 67 && e.shiftKey && (e.ctrlKey || e.metaKey)) {
                            return false;
                        }
                        if (e.keyCode == 'J'.charCodeAt(0) && e.altKey && (e.ctrlKey || e.metaKey)) {
                            return false;
                        }
                        if (e.keyCode == 'I'.charCodeAt(0) && e.altKey && (e.ctrlKey || e.metaKey)) {
                            return false;
                        }
                        if ((e.keyCode == 'V'.charCodeAt(0) && e.metaKey) || (e.metaKey && e.altKey)) {
                            return false;
                        }
                        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)) {
                            return false;
                        }
                        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
                            return false;
                        }
                    }
                    if (document.addEventListener) {
                        document.addEventListener('contextmenu', function(e) {
                            e.preventDefault();
                        }, false);
                    } else {
                        document.attachEvent('oncontextmenu', function() {
                            window.event.returnValue = false;
                        });
                    }
                </script>
                <script>
                    // Function to show the loading spinner and submit the form
                    function submitFormWithLoading() {
                        // Display the loading spinner
                        document.getElementById('loadingSpinner').style.display = 'block';

                        // Submit the form
                        document.getElementById('paymentForm').submit();
                    }

                    // Countdown timer
                    var countdownValue = 5;
                    var countdownElement = document.getElementById('countdown');

                    function updateCountdown() {
                        countdownElement.innerText = countdownValue;
                        countdownValue--;

                        if (countdownValue < 0) {
                            submitFormWithLoading(); // Trigger form submission after countdown
                        } else {
                            setTimeout(updateCountdown, 1000); // Update countdown every 1 second
                        }
                    }

                    // Start the countdown
                    updateCountdown();
                </script>

    </body>

    </html>
