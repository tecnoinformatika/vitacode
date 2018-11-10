<?php

namespace Ideas\Shop\Facades;

use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\TaxRate;
use Ideas\Shop\Models\TaxRule;
use \October\Rain\Database\Model;

class Price extends Model
{
    /**
     * Get all tax
     */
    public static function getTax()
    {
        $taxRule = TaxRule::select('tax_class_id', 'tax_rate_id')
            ->get()
            ->toArray();
        $taxRate = TaxRate::select('id', 'type', 'rate')
            ->get()
            ->toArray();
        $taxRateConvert = [];
        foreach ($taxRate as $row) {
            $taxRateConvert[$row['id']] = [
                'type' => $row['type'],
                'rate' => $row['rate']
            ];
        }
        $taxRuleConvert = [];
        foreach ($taxRule as $row) {
            $taxRuleConvert[$row['tax_class_id']][] = $row['tax_rate_id'];
        }
        $taxClassArray = [];
        foreach ($taxRuleConvert as $key => $value) {
            $array = [];
            foreach ($value as $v) {
                if (array_key_exists($v, $taxRateConvert)) {
                    $array[] = $taxRateConvert[$v];
                } else {
                    $array[] = '';
                }
            }
            $taxClassArray[$key] = $array;
        }
        return $taxClassArray;
    }

    /**
     * Calculate price with tax
     */
    public static function finalPrice($price, $taxClassId, $taxClassArray)
    {
        $finalPrice = $price;
        if (array_key_exists($taxClassId, $taxClassArray)) {
            $taxClassForPrice = $taxClassArray[$taxClassId];
            foreach ($taxClassForPrice as $row) {
                if ($row['type'] == TaxRate::TYPE_PERCENTAGE && $row['rate'] != 0) {
                    $finalPrice += ($row['rate'] / 100) * $price;
                }
                if ($row['type'] == TaxRate::TYPE_FIXED) {
                    $finalPrice += $row['rate'];
                }
            }
        }
        return $finalPrice;
    }

    /**
     * Convert product object to array has final_price
     * output: array
     */
    public static function addFinalPriceForProduct($data)
    {
        $dataArray = IdeasShop::objectToArray($data);
        $rs = [];
        $taxClassArray = self::getTax();
        foreach ($dataArray as $row) {
            $row['final_price'] = self::finalPrice($row['price'], $row['tax_class_id'], $taxClassArray);
            $rs[] = $row;
        }
        return $rs;
    }

    /**
     * Add final price for config product
     */
    public static function addFinalPriceForChildConfig($data)
    {
        $rs = [];
        $taxClassArray = self::getTax();
        foreach ($data as $key => $value) {
            $value['final_price'] = self::finalPrice($value['price'], $value['tax_class_id'], $taxClassArray);
            $rs[$key] = $value;
        }
        return $rs;
    }

    /**
     * add final_price to product object
     * output : object
     */
    public static function addFinalPriceForProductObject($data)
    {
        $taxClassArray = self::getTax();
        foreach ($data as $row) {
            $row->final_price = self::finalPrice($row->price, $row->tax_class_id, $taxClassArray);
        }
        return $data;
    }

    /**
     * add final_price for detail product
     * output: object
     */
    public static function addFinalPriceForDetailProduct($data)
    {
        $taxClassArray = self::getTax();
        $data->final_price = self::finalPrice($data->price, $data->tax_class_id, $taxClassArray);
        return $data;
    }

    /**
     * Add final_price for detail product
     * input : array
     * output: array
     */
    public static function addFinalPriceForDetailProductArray($data)
    {
        $taxClassArray = self::getTax();
        $data['final_price'] = self::finalPrice($data['price'], $data['tax_class_id'], $taxClassArray);
        return $data;
    }
}