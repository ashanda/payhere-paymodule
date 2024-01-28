
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h4>Recurring Payment Details</h4>
            <h4>You can find the Payment details for an Order.</h4>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <form action="{{ route('recurring-payment') }}" method="get">
                <div class="form-group row">
                    <label for="app_id" class="col-sm-2 col-form-label">Business App ID</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="app_id" value="{{ $app_id }}" name="app_id" placeholder="">
                        <small><em>You can leave this field.</em></small>
                        <p class="text-danger"></p>
                    </div>
                    <div class="col-sm-4">
                        How to get Business App ID -: <a href="https://support.payhere.lk/api-&-mobile-sdk/payhere-retrieval">Retrieval API</a> and Read the First Step
                    </div>
                </div>
                <!-- ... (rest of the form) ... -->
                <div class="form-group row">
                    <div class="col-lg-6 text-right">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ... (rest of the HTML structure) ... -->
</div