<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>
    <table>
        <tr>
            <td>
                {{ $invoice->company_name }}
            </td>
            <td>
                <h2>Invoice ID: {{ $invoice->id }}</h2>
            </td>
        </tr>
    </table>

    <div>
        <table>
            <tr>
                <td>
                    <div>
                        <h4>To:</h4>
                    </div>
                    <div>{{ $invoice->client_name }}</div>
                    <div>
                        {{ $invoice->client_address_line_1 }}
                        {{ $invoice->client_address_line_2 }}
                        {{ $invoice->client_city }}
                        {{ $invoice->client_county }}
                        {{ $invoice->client_postcode }}
                    </div>
                </td>
                <td>
                    <div>
                        <h4>From:</h4>
                    </div>
                    <div>{{ $invoice->company_name }}</div>
                    <div>
                        VAT number : {{ $invoice->company_vat_number }}
                    </div>
                    <div>
                        {{ $invoice->company_address_line_1 }}
                        {{ $invoice->company_address_line_2 }}
                        {{ $invoice->company_city }}
                        {{ $invoice->company_county }}
                        {{ $invoice->company_postcode }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div>
        <table>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Unit</th>
                <th>Total charge</th>
            </tr>
            <tr>
                @foreach ($invoice->products as $product)
                    <td>
                        {{ $product['name'] }}
                    </td>
                    <td>
                        {{ $product['amount'] }}
                    </td>
                    <td>
                        {{ $product['unit'] }}
                    </td>
                    <td>
                        {{ $product['total_charge'] }}
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    <div>

    </div>
</body>

</html>
