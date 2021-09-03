
<style>
table, th, td {
    padding: 5px;
  }
</style>

<p>Dear Sir/Madam,<br/></p>
<p>This is to inform you that your payment was successful.</p>

<div style="align-content: center">
    <table style="width: 30%;">
        <tbody style="background-color:hsla(11, 41%, 92%, 0.705);">
            <tr>
                <td>&nbsp;User Name</td>
                <td style="text-align: right">{{Str::title($data['user']->first_name .' '. $data['user']->last_name)}}&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;User Email</td>
                <td style="text-align: right">{{$data['user']->email}}&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;Date</td>
                <td style="text-align: right">{{$data['date']}}&nbsp;</td>
            </tr>
            <tr>
                <td><span>&nbsp;Package Price</span></td>
                <td style="text-align: right"><span>{{$data['package_price']}}&nbsp;</span></td>
            </tr>
            <tr>
                <td><h3>&nbsp;Total</h3></td>
                <td style="text-align: right"><h3>{{$data['package_price']}}&nbsp;</h3></td>
            </tr>
        </tbody>
    </table>
</div><br/>


<p>Best regards.<br/>The Flex Fitness Team</p>

<p>This email is tracked automatically via Flex Fitness's Mail Servers.</p>

<p>Flex Fitness Ltd<br>Unit C1 and C2 Brearley Place,<br>Baird Road,<br>Quedgeley<br>Gloucester, GL2 2GB</p>

<p>Tel (Sales): 03300167681<br>Fax : 03300167689<br>Support Line : 03300167680</p>

<p>Web : http://www.flexfitness.com</p>

