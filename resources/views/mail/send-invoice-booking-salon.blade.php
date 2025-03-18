<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-light.css">

    <style>
        * {
            font-family: "Poppins";
        }
    </style>
</head>

<body>
    <div style="border:solid 1px #eee;border-radius:4px;padding:30px 20px">
        <div style="padding-bottom:10px">
            <div
                style="margin:0 auto;max-width:850px;width:100%;border-radius:3px;overflow:hidden;border:solid 1px #eee;margin-bottom:30px">
                <div style="background-color:#44403b;padding:20px 30px;color:#fff">
                    <h3 style="font-weight:400"><span class="il">Tangerine | Salon and Wellness</h3>
                </div>
                <div style="background-color:#fff;padding:20px 30px 30px 30px;text-align:left">
                    <div>
                        <h4 style="font-weight:normal">Hi Tangerine Customer,</h4>
                        <p style="margin-bottom:5px">Thank you for making a purchase at <span
                                style="font-weight: 600">Tangerine</span>. here is your
                            transaction invoice :</p>
                    </div>
                    <br>
                    <div>
                        <h3 style="margin-bottom:20px;text-align:center">Invoice</h3>
                        <hr style="margin-bottom:20px">
                        <table style="border-collapse:collapse;width:100%;table-layout:fixed">
                            <tbody>
                                <tr>
                                    <td>Invoice ID</td>
                                    <td style="text-align:right">{{ $data['invoice'] }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Date</td>
                                    <td style="text-align:right">{{ format_date($data['transaction_date']) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;width:100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <h4 style="margin:20px 0px 10px 0px">Transaction Detail</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $data['label'] }}</td>
                                    <td style="text-align:right">{{ format_rupiah($data['total']) }}</td>
                                </tr>
                                <tr>
                                    <td>Customer Name : {{ $data['customer_name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Booking Date :
                                        {{ Carbon\Carbon::parse($data['booking_date'])->format('l, d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="text-transform: capitalize">Session : {{ $data['session'] }}</td>
                                </tr>
                                <tr>
                                    <td>Queue Number : {{ $data['queue_number'] }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td style="text-align:right">{{ format_rupiah($data['total']) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr style="margin-top:10px">
                    </div>
                    {{-- <div>
                        <h4 style="margin-bottom:20px;text-align:center">Proof Of Payment</h4>
                        <img style="display: block; margin: 0 auto;"
                            src="https://tangerine.my.id/uploads/proofs/{{ $data['proof_of_payment'] }}" alt="">
                        <hr style="margin-top:30px">
                    </div> --}}
                    <br>
                    <p style="font-size:14px;margin-bottom:30px">Having trouble with this transaction? Contact us
                        at <a href="mailto:website@tangerine.my.id" target="_blank">website@<span
                                class="il">tangerine</span>.my.id</a>.</p>
                    <p style="margin-bottom:7px">Thank you,</p>
                    <p style="margin-top:0px"><span class="il">Tangerine</span></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
