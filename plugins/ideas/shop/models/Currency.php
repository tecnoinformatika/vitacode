<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Currency extends Model
{
    use Validation;

    protected $table = 'ideas_currency';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'name' => 'required',
        'symbol' => 'required'
    ];

    const POSITION_BEFORE = 0;
    const POSITION_AFTER = 1;

    public static function getCurrencyCodeById($id)
    {
        $defaultCode = 'USD';
        if ($id != null) {
            $data = self::select('code')
                ->where('id', $id)
                ->first();
            $code = $defaultCode;
            if ($data != null) {
                $code = $data['code'];
            }
        } else {
            $code = $defaultCode;//default USD
        }

        return $code;
    }

    /**
     * Use google finance -
     */
//    public static function convertCurrency($amount, $from, $to)
//    {
//        $url  = "https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to";
//        $data = file_get_contents($url);
//        preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
//        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
//        return round($converted, 3);
//    }

    /**
     * Use free convert currency
     */
    public static function convertCurrency($amount, $from, $to)
    {
        $url = file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . $from . '_' . $to . '&compact=ultra');
        $json = json_decode($url, true);
        $rate = implode(" ", $json);
        $total = $rate * $amount;
        $rounded = round($total, 3); //optional, rounds to a whole number
        return $rounded; //or return $rounded if you kept the rounding bit from above
    }

    /**
     * Update currency value
     */
    public static function updateCurrencyValue()
    {
        $currency = Config::getConfigDefault();
        $currency == '' ? $currencyDefaultId = 1 : $currencyDefaultId = $currency['currency_default'];
        $defaultCurrency = self::getCurrencyCodeById($currencyDefaultId);
        $currency = self::select('id', 'code')
            ->get()
            ->toArray();
        $currencyIdArray = [];
        foreach ($currency as $row) {
            $currencyIdArray[$row['id']] = $row['code'];
        }
        foreach ($currencyIdArray as $key => $value) {
            $value = self::convertCurrency(1, $defaultCurrency, $value);
            $now = date('Y:m:d H:i:s');
            self::where('id', $key)->update(['value'=>$value, 'date_modified'=>$now]);
        }
    }

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_currency', [$dataSaved, $post]);
    }

    public function getCodeOptions()
    {
        $code = [
            'AED' => 'United Arab Emirates Dirham (AED)',
            'AFN' => 'Afghan Afghani (AFN)',
            'ALL' => 'Albanian Lek (ALL)',
            'AMD' => 'Armenian Dram (AMD)',
            'ANG' => 'Netherlands Antillean Guilder (ANG)',
            'AOA' => 'Angolan Kwanza (AOA)',
            'ARS' => 'Argentine Peso (ARS)',
            'AUD' => 'Australian Dollar (A$)',
            'AWG' => 'Aruban Florin (AWG)',
            'AZN' => 'Azerbaijani Manat (AZN)',
            'BAM' => 'Bosnia-Herzegovina Convertible Mark (BAM)',
            'BBD' => 'Barbadian Dollar (BBD)',
            'BDT' => 'Bangladeshi Taka (BDT)',
            'BGN' => 'Bulgarian Lev (BGN)',
            'BHD' => 'Bahraini Dinar (BHD)',
            'BIF' => 'Burundian Franc (BIF)',
            'BMD' => 'Bermudan Dollar (BMD)',
            'BND' => 'Brunei Dollar (BND)',
            'BOB' => 'Bolivian Boliviano (BOB)',
            'BRL' => 'Brazilian Real (R$)',
            'BSD' => 'Bahamian Dollar (BSD)',
            'BTC' => 'Bitcoin (฿)',
            'BTN' => 'Bhutanese Ngultrum (BTN)',
            'BWP' => 'Botswanan Pula (BWP)',
            'BYN' => 'Belarusian Ruble (BYN)',
            'BYR' => 'Belarusian Ruble (2000–2016) (BYR)',
            'BZD' => 'Belize Dollar (BZD)',
            'CAD' => 'Canadian Dollar (CA$)',
            'CDF' => 'Congolese Franc (CDF)',
            'CHF' => 'Swiss Franc (CHF)',
            'CLF' => 'Chilean Unit of Account (UF) (CLF)',
            'CLP' => 'Chilean Peso (CLP)',
            'CNH' => 'CNH (CNH)',
            'CNY' => 'Chinese Yuan (CN¥)',
            'COP' => 'Colombian Peso (COP)',
            'CRC' => 'Costa Rican Colón (CRC)',
            'CUP' => 'Cuban Peso (CUP)',
            'CVE' => 'Cape Verdean Escudo (CVE)',
            'CZK' => 'Czech Republic Koruna (CZK)',
            'DEM' => 'German Mark (DEM)',
            'DJF' => 'Djiboutian Franc (DJF)',
            'DKK' => 'Danish Krone (DKK)',
            'DOP' => 'Dominican Peso (DOP)',
            'DZD' => 'Algerian Dinar (DZD)',
            'EGP' => 'Egyptian Pound (EGP)',
            'ERN' => 'Eritrean Nakfa (ERN)',
            'ETB' => 'Ethiopian Birr (ETB)',
            'EUR' => 'Euro (€)',
            'FIM' => 'Finnish Markka (FIM)',
            'FJD' => 'Fijian Dollar (FJD)',
            'FKP' => 'Falkland Islands Pound (FKP)',
            'FRF' => 'French Franc (FRF)',
            'GBP' => 'British Pound (£)',
            'GEL' => 'Georgian Lari (GEL)',
            'GHS' => 'Ghanaian Cedi (GHS)',
            'GIP' => 'Gibraltar Pound (GIP)',
            'GMD' => 'Gambian Dalasi (GMD)',
            'GNF' => 'Guinean Franc (GNF)',
            'GTQ' => 'Guatemalan Quetzal (GTQ)',
            'GYD' => 'Guyanaese Dollar (GYD)',
            'HKD' => 'Hong Kong Dollar (HK$)',
            'HNL' => 'Honduran Lempira (HNL)',
            'HRK' => 'Croatian Kuna (HRK)',
            'HTG' => 'Haitian Gourde (HTG)',
            'HUF' => 'Hungarian Forint (HUF)',
            'IDR' => 'Indonesian Rupiah (IDR)',
            'IEP' => 'Irish Pound (IEP)',
            'ILS' => 'Israeli New Shekel (₪)',
            'INR' => 'Indian Rupee (₹)',
            'IQD' => 'Iraqi Dinar (IQD)',
            'IRR' => 'Iranian Rial (IRR)',
            'ISK' => 'Icelandic Króna (ISK)',
            'ITL' => 'Italian Lira (ITL)',
            'JMD' => 'Jamaican Dollar (JMD)',
            'JOD' => 'Jordanian Dinar (JOD)',
            'JPY' => 'Japanese Yen (¥)',
            'KES' => 'Kenyan Shilling (KES)',
            'KGS' => 'Kyrgystani Som (KGS)',
            'KHR' => 'Cambodian Riel (KHR)',
            'KMF' => 'Comorian Franc (KMF)',
            'KPW' => 'North Korean Won (KPW)',
            'KRW' => 'South Korean Won (₩)',
            'KWD' => 'Kuwaiti Dinar (KWD)',
            'KYD' => 'Cayman Islands Dollar (KYD)',
            'KZT' => 'Kazakhstani Tenge (KZT)',
            'LAK' => 'Laotian Kip (LAK)',
            'LBP' => 'Lebanese Pound (LBP)',
            'LKR' => 'Sri Lankan Rupee (LKR)',
            'LRD' => 'Liberian Dollar (LRD)',
            'LSL' => 'Lesotho Loti (LSL)',
            'LTL' => 'Lithuanian Litas (LTL)',
            'LVL' => 'Latvian Lats (LVL)',
            'LYD' => 'Libyan Dinar (LYD)',
            'MAD' => 'Moroccan Dirham (MAD)',
            'MDL' => 'Moldovan Leu (MDL)',
            'MGA' => 'Malagasy Ariary (MGA)',
            'MKD' => 'Macedonian Denar (MKD)',
            'MMK' => 'Myanmar Kyat (MMK)',
            'MNT' => 'Mongolian Tugrik (MNT)',
            'MOP' => 'Macanese Pataca (MOP)',
            'MRO' => 'Mauritanian Ouguiya (MRO)',
            'MUR' => 'Mauritian Rupee (MUR)',
            'MVR' => 'Maldivian Rufiyaa (MVR)',
            'MWK' => 'Malawian Kwacha (MWK)',
            'MXN' => 'Mexican Peso (MX$)',
            'MYR' => 'Malaysian Ringgit (MYR)',
            'MZN' => 'Mozambican Metical (MZN)',
            'NAD' => 'Namibian Dollar (NAD)',
            'NGN' => 'Nigerian Naira (NGN)',
            'NIO' => 'Nicaraguan Córdoba (NIO)',
            'NOK' => 'Norwegian Krone (NOK)',
            'NPR' => 'Nepalese Rupee (NPR)',
            'NZD' => 'New Zealand Dollar (NZ$)',
            'OMR' => 'Omani Rial (OMR)',
            'PAB' => 'Panamanian Balboa (PAB)',
            'PEN' => 'Peruvian Sol (PEN)',
            'PGK' => 'Papua New Guinean Kina (PGK)',
            'PHP' => 'Philippine Peso (PHP)',
            'PKG' => 'PKG (PKG)',
            'PKR' => 'Pakistani Rupee (PKR)',
            'PLN' => 'Polish Zloty (PLN)',
            'PYG' => 'Paraguayan Guarani (PYG)',
            'QAR' => 'Qatari Rial (QAR)',
            'RON' => 'Romanian Leu (RON)',
            'RSD' => 'Serbian Dinar (RSD)',
            'RUB' => 'Russian Ruble (RUB)',
            'RWF' => 'Rwandan Franc (RWF)',
            'SAR' => 'Saudi Riyal (SAR)',
            'SBD' => 'Solomon Islands Dollar (SBD)',
            'SCR' => 'Seychellois Rupee (SCR)',
            'SDG' => 'Sudanese Pound (SDG)',
            'SEK' => 'Swedish Krona (SEK)',
            'SGD' => 'Singapore Dollar (SGD)',
            'SHP' => 'St. Helena Pound (SHP)',
            'SKK' => 'Slovak Koruna (SKK)',
            'SLL' => 'Sierra Leonean Leone (SLL)',
            'SOS' => 'Somali Shilling (SOS)',
            'SRD' => 'Surinamese Dollar (SRD)',
            'STD' => 'São Tomé &amp; Príncipe Dobra (STD)',
            'SVC' => 'Salvadoran Colón (SVC)',
            'SYP' => 'Syrian Pound (SYP)',
            'SZL' => 'Swazi Lilangeni (SZL)',
            'THB' => 'Thai Baht (THB)',
            'TJS' => 'Tajikistani Somoni (TJS)',
            'TMT' => 'Turkmenistani Manat (TMT)',
            'TND' => 'Tunisian Dinar (TND)',
            'TOP' => 'Tongan Paʻanga (TOP)',
            'TRY' => 'Turkish Lira (TRY)',
            'TTD' => 'Trinidad &amp; Tobago Dollar (TTD)',
            'TWD' => 'New Taiwan Dollar (NT$)',
            'TZS' => 'Tanzanian Shilling (TZS)',
            'UAH' => 'Ukrainian Hryvnia (UAH)',
            'UGX' => 'Ugandan Shilling (UGX)',
            'USD' => 'US Dollar ($)',
            'UYU' => 'Uruguayan Peso (UYU)',
            'UZS' => 'Uzbekistani Som (UZS)',
            'VEF' => 'Venezuelan Bolívar (VEF)',
            'VND' => 'Vietnamese Dong (₫)',
            'VUV' => 'Vanuatu Vatu (VUV)',
            'WST' => 'Samoan Tala (WST)',
            'XAF' => 'Central African CFA Franc (FCFA)',
            'XCD' => 'East Caribbean Dollar (EC$)',
            'XDR' => 'Special Drawing Rights (XDR)',
            'XOF' => 'West African CFA Franc (CFA)',
            'XPF' => 'CFP Franc (CFPF)',
            'YER' => 'Yemeni Rial (YER)',
            'ZAR' => 'South African Rand (ZAR)',
            'ZMK' => 'Zambian Kwacha (1968–2012) (ZMK)',
            'ZMW' => 'Zambian Kwacha (ZMW)',
            'ZWL' => 'Zimbabwean Dollar (2009) (ZWL)'
        ];
        return $code;
    }
}