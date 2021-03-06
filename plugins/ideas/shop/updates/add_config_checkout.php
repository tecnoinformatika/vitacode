<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Seeder;

class AddConfigCheckout extends Seeder
{
    public function run()
    {
        $dataConfig = [
            [
                'name' => 'Checkout Success Url',
                'slug' => 'checkout_ok_url',
                'value' => 'checkout-ok',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Checkout Fail Url',
                'slug' => 'checkout_fail_url',
                'value' => 'checkout-fail',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Invoice Css',
                'slug' => 'invoice_css',
                'value' => '<style>
    #invoice-div {
        margin: 0 auto;
        max-width: 1024px;
    }
    .table-invoice {
        width: 100%;
        border: 1px #cccccc solid;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    .table-invoice tr th{
        border: 1px #cccccc solid;
    }
    .table-invoice tr td {
        border-right: 1px #cccccc solid;
    }
    .table-invoice tr td {
        padding-left: 10px;
    }
    .table-invoice tr th p {
        float: left;
        margin-left: 10px;
        font-weight: bold;
    }
    .no-border-right {
        border-right: none !important;
    }
    .table-product tr td {
        border-bottom: 1px #cccccc solid;
        padding: 10px;
    }
    .text-bold {
        font-weight: bold;
    }
</style>',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Invoice Template',
                'slug' => 'invoice_template',
                'value' => '<div id="invoice-div">
    <h3>INVOICE #{{ order.id }}</h3>
    <table class="table-invoice">
        <thead>
        <tr>
            <th colspan="2">Order Detail</p></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                Telephone 123456789<br/>
                E-Mail admin@admin.to<br/>
                Web Site: http://ideasshop.local<br/>
            </td>
            <td>
                Date Added {{now}}<br/>
                Order ID: {{ order.id }}<br/>
                Payment Method : {{ order.payment_method_name }}<br/>
                Shipping Method : {{ order.shipping_rule_name }}<br/>
            </td>
        </tr>

        </tbody>
    </table>
    <table class="table-invoice">
        <thead>
        <tr>
            <th><p>Billing Address</p></th>
            <th><p>Shipping Address</p></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ order.billing_name }}</td>
            <td>{{ order.shipping_name }}</td>
        </tr>
        <tr>
            <td>{{ order.billing_address }}</td>
            <td>{{ order.shipping_address }}</td>
        </tr>
        <tr>
            <td>{{ order.billing_phone }}</td>
            <td>{{ order.shipping_phone }}</td>
        </tr>
        <tr>
            <td>{{ order.billing_email }}</td>
            <td>{{ order.shipping_email }}</td>
        </tr>
        <tr>
            <td>Shipping :
                {{ order.shipping_rule_name }}</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <table class="table-invoice table-product">
        <thead>
        <tr>
            <th><p>Product</p></th>
            <th><p>Quantity</p></th>
            <th><p>Price after tax</p></th>
            <th><p>Total</p></th>
        </tr>
        </thead>
        <tbody>
        {% for row in product %}
        <tr>
            <td>
                {{ row.name }}
            </td>
            <td>{{ row.qty }}</td>
            <td>{{ row.price_after_tax | displayPriceAndCurrency }}</td>
            {% set priceWithQty = row.qty * row.price_after_tax %}
            <td>{{ priceWithQty | displayPriceAndCurrency}}</td>
        </tr>
        {% endfor %}
        <tr>
            <td class="no-border-right"></td>
            <td class="no-border-right"></td>
            <td class="text-bold">Shipping Cost</td>
            <td>{{ shipping_cost | displayPriceAndCurrency }}</td>
        </tr>
        <tr>
            <td class="no-border-right"></td>
            <td class="no-border-right"></td>
            <td class="text-bold">Total</td>
            <td>{{ total | displayPriceAndCurrency }}</td>
        </tr>
        </tbody>
    </table>
</div>',
                'is_default' => Config::IS_DEFAULT
            ]
        ];
        Config::insert($dataConfig);
    }
}