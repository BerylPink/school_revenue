
<input type="hidden" nane="fee_category[]" value="">

@if($is_displayed == 1)

            <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                <div class="card-body">
                    <table id="basicExample" class="table table-bordered table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>S/N</th>
                            <th class="text-center">Check Option</th>
                            <th>Fee Name</th>
                            <th>Amount (₦)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form>
                        @foreach($feeCategories as $feeCategory)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><div class="form-check ml-4 text-center"><input class="form-check-input check-box" id="check-box" type="checkbox" value="" ></div></td>
                                <td>{{ $feeCategory->fee_name }}</td>
                                <td><span class="fees-amount">{{ $feeCategory->amount }}</span></td>
                                <td style="border: none">
                                {{-- <input type="hidden" class="fees-category" value="{{ $feeCategory->id }}">
                                <input type="hidden" name="fee_category[]" id="feeCategory" value="">
                                <input type="hidden" name="amount_paid[]" id="feeAmount" value=""> --}}

                                <input type="hidden" class="fees-category" name="fee_category[]" id="feeCategory" value="{{ $feeCategory->id }}" disabled>
                                <input type="hidden" class="fees-amount" name="amount_paid[]" id="feeAmount" value="{{ $feeCategory->amount }}" disabled>
                                </td>
                            </tr>
                        @endforeach
                        </form>
                    <td colspan="4">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Total</strong>
                        </div>
                        <div class="col-md-6 mr-auto table-total" style="margin-right: .1em;">
                        </div>
                        </div>
                    </td>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>

            <script>

            $(".check-box").change(function(){
        
                let total = 0;

                $(".check-box:checked").each(function(){
                    // total += parseFloat($(this).parent().next("td").find(".fees-amount").text());
                    total += parseFloat($(this).parent().parent().nextAll("td").find(".fees-amount").text());
                    
                    $(this).parent().parent().nextAll("td").find(".fees-category, .fees-amount").removeAttr('disabled');

                    $(this).on('change', function(){
                        if ($(this).prop('checked') == true) {
                            $(this).parent().parent().nextAll("td").find(".fees-category, .fees-amount").removeAttr('disabled');

                        }else{
                            $(this).parent().parent().nextAll("td").find(".fees-category, .fees-amount").attr('disabled', true);
                        }
                    });

                });

        
                $(".table-total, #final_amount, #fee_amount").text("₦"+total);
                // console.log(total);
                $("#fee_interface, #payment_gateway").removeClass("d-none").addClass("fadeIn");
            });
            </script>
@endif