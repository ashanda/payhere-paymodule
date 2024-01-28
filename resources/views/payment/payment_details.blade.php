<!-- resources/views/payment/payment_details.blade.php -->

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-html-tab" data-toggle="tab" href="#nav-html" role="tab" aria-controls="nav-home" aria-selected="true">HTML</a>
                    <a class="nav-item nav-link" id="nav-json-tab" data-toggle="tab" href="#nav-json" role="tab" aria-controls="nav-profile" aria-selected="false">JSON</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-html" role="tabpanel" aria-labelledby="nav-html-tab">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <!-- ... (rest of the table headers) ... -->
                            </tr>
                        </thead>
                        <tbody id="modal_tbody">
                            @if (!isset($_GET['order_id']) || empty($payment_data))
                                <tr>
                                    <td colspan="8"><p class="text-center"><em>{{ $msg }}</em></p></td>
                                </tr>
                            @else
                                @foreach ($payment_data as $payment)
                                    <tr>
                                        <td>{{ $payment['payment_id'] }}</td>
                                        <!-- ... (rest of the table data) ... -->
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- ... (rest of the HTML structure) ... -->
                </div>
                <div class="tab-pane fade" id="nav-json" role="tabpanel" aria-labelledby="nav-json-tab">
                    <pre class="bg-dark text-white p-3">{{ $json_string }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
