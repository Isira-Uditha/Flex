<div class="table-responsive">
    <table class="table table-borderless">
        <tbody style="background-color:hsla(11, 41%, 92%, 0.705);">
            <tr>
                <td class="text-right tx-bold">&nbsp;Invoice No</td>
                <td>&nbsp;:</td>
                <td class="text-left tx-bold">{{$data['payment']->payment_id}}&nbsp;</td>
            </tr>
            <tr>
                <td class="text-right tx-bold">&nbsp;User Name</td>
                <td>&nbsp;:</td>
                <td class="text-left">{{Str::title($data['user']->first_name .' '. $data['user']->last_name)}}&nbsp;</td>
            </tr>
            <tr>
                <td class="text-right tx-bold">&nbsp;User Email</td>
                <td>&nbsp;:</td>
                <td class="text-left">{{$data['user']->email}}&nbsp;</td>
            </tr>
            <tr>
                <td class="text-right tx-bold">&nbsp;Current Date</td>
                <td>&nbsp;:</td>
                <td class="text-left">{{$data['payment']->payment_date}}&nbsp;</td>
            </tr>
            <tr>
                <td class="text-right tx-bold"><span>&nbsp;Package Price</span></td>
                <td>&nbsp;:</td>
                <td class="text-left"><span>{{'Rs. '. $data['package']->package_price}}&nbsp;</span></td>
            </tr>
            <tr>
                <td class="text-right"><h3>&nbsp;Total</h3></td>
                <td>&nbsp;:</td>
                <td class="text-left"><h3>{{'Rs. '. $data['package']->package_price}}&nbsp;</h3></td>
            </tr>
        </tbody>
    </table>
</div><br/>

@push('scripts')
<script>

</script>
@endpush
