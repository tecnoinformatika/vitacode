<?php
/**
 * Save configurable product
 */
namespace Ideas\Shop\Facades;

use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\ProductChildToCategory;
use Ideas\Shop\Models\ProductConfigurable;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\ProductToFilterOption;
use \October\Rain\Database\Model;

class Configurable extends Model
{

    /**
     * Insert product child
     * return product child id
     */
    public static function saveProductChild($productParentData, $row)
    {
        $productChild = [
            'name' => $productParentData['name'].'-'.$row['str_variant_label'],
            'qty' => $row['qty'] != '' ? $row['qty'] : $productParentData['qty'],
            'price' => $row['price'] != '' ? $row['price'] : $productParentData['price'],
            'tax_class_id' => $productParentData['tax_class_id'],
            'product_type' => Products::PRODUCT_TYPE_CONFIGURABLE_CHILD,
            'featured_image' => $row['featured_image'],
            'gallery' => !empty($row['gallery']) ? implode(';', $row['gallery']) : '',
            'status' => IdeasShop::ENABLE
        ];
        if ($row['id_update'] == 0) {
            $idChild = Products::insertGetId($productChild);
        } else {
            Products::where('id', $row['id_update'])->update($productChild);
            $idChild = $row['id_update'];
        }
        return $idChild;
    }

    /**
     * Insert configurable data
     */
    public static function saveConfigurableData($productId, $idChild, $row)
    {
        $configurable = [
            'str_filter_id' => $row['str_filter_id'],
            'str_filter_option_id' => $row['str_filter_option_id'],
            'str_filter_option_label' => $row['str_variant_label'],
            'pc_product_id' => $idChild,
            'product_id' => $productId
        ];
        if ($row['id_update'] == 0) {
            ProductConfigurable::insert($configurable);
        } else {
            ProductConfigurable::where('pc_product_id', $row['id_update'])->update($configurable);
        }
    }

    /**
     * Insert filter option for product parent
     */
    public static function saveFilterOptionForProductParent($arrayFilterOptionConfig, $productId)
    {
        $arrayFilterOptionConfigUnique = array_unique($arrayFilterOptionConfig);
        $dataFilterOption = [];
        foreach ($arrayFilterOptionConfigUnique as $row) {
            $dataFilterOption[] = [
                'product_id' => $productId,
                'filter_option_id' => $row
            ];
        }
        //insert to #_product_to_filter_option
        ProductToFilterOption::insert($dataFilterOption);
    }

    /**
     * Save category for config child
     */
    public static function saveCategoryForConfigChild($categoryId, $idChild, $row)
    {
        $data = [];
        if ($row['id_update'] != 0) {//update
            ProductChildToCategory::where('product_id', $idChild)->delete();
        }
        foreach ($categoryId as $row) {
            $data[] = [
                'product_id' => $idChild,
                'category_id' => $row
            ];
        }
        ProductChildToCategory::insert($data);
    }

    /**
     * Delete product config
     */
    public static function deleteProductConfig($arrayIdDelete)
    {
        Products::whereIn('id', $arrayIdDelete)->delete();
        ProductConfigurable::whereIn('pc_product_id', $arrayIdDelete)->delete();
    }

    /**
     * Get id to delete
     */
    public static function getOldIdToDelete($post, $variantArray)
    {
        $idUpdateOldArray = explode(',', $post['id_update_old']);
        $idUpdateArray = [];
        foreach ($variantArray as $row) {
            if ($row['id_update'] != 0) {
                $idUpdateArray[] = (int) $row['id_update'];
            }
        }
        $arrayIdDelete = array_diff($idUpdateOldArray, $idUpdateArray);
        $arrayIdDelete = array_values($arrayIdDelete);
        return $arrayIdDelete;
    }

    /**
     * Save configurable product
     */
    public static function saveConfigurableProduct($productId, $post)
    {
        $variantArray = json_decode($post['variant_json'], true);
        $productParentData = $post['Products'];
        $arrayFilterOptionConfig = [];
        foreach ($variantArray as $row) {
            //save product child
            $idChild = self::saveProductChild($productParentData, $row);
            //save configurable data
            self::saveConfigurableData($productId, $idChild, $row);
            $filterOptionIdArray = explode(',', $row['str_filter_option_id']);
            foreach ($filterOptionIdArray as $f) {
                $arrayFilterOptionConfig[] = $f;
            }
            self::saveCategoryForConfigChild($post['Products']['_category'], $idChild, $row);
        }
        //save filter option for product parent
        self::saveFilterOptionForProductParent($arrayFilterOptionConfig, $productId);
        $oldIdToDelete = self::getOldIdToDelete($post, $variantArray);
        if (!empty($oldIdToDelete)) {
            self::deleteProductConfig($oldIdToDelete);
        }
    }

    /**
     * Convert configurable data
     */
    public static function convertConfigData($productConfigData)
    {
        $config = [];
        $validateVariant = [];
        $idUpdateOld = [];
        foreach ($productConfigData as $row) {
            $config[] = [
                'qty' => $row['qty'],
                'price' => $row['price'],
                'featured_image' => $row['featured_image'],
                'gallery' => explode(',', $row['gallery']),
                'str_filter_id' => $row->configurable->str_filter_id,
                'str_filter_option_id' => $row->configurable->str_filter_option_id,
                'str_variant_label' => $row->configurable->str_filter_option_label,
                'id_update' => $row['id']
            ];
            $validateVariant[] = str_replace(',', '-', $row->configurable->str_filter_option_id);
            $idUpdateOld[] = $row['id'];
        }
        return [
            'config' => $config,
            'validateVariant' => $validateVariant,
            'idUpdateOld' => implode(',', $idUpdateOld)
        ];
    }

    /**
     * Get configurable data to update
     */
    public static function getConfigurableData($productId)
    {
        $productChildConfig = ProductConfigurable::select('pc_product_id')->where('product_id', $productId)
            ->get();
        $productChildIdArray = [];
        foreach ($productChildConfig as $row) {
            $productChildIdArray[] = $row['pc_product_id'];
        }
        $productConfigData = Products::whereIn('id', $productChildIdArray)
            ->with('configurable')->get();
        return self::convertConfigData($productConfigData);
    }

}