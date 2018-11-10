<?php

namespace Ideas\Shop\Controllers;

use BackendMenu;
use Backend;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\OrderProduct;
use Ideas\Shop\Models\OrderReturn;
use Ideas\Shop\Models\OrderStatus;
use Ideas\Shop\Models\ProductDownloadableLink;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\Reason;
use Ideas\Shop\Models\Ship;
use October\Rain\Support\Facades\Twig;
use View;
use Flash;
use Ideas\Shop\Models\OrderStatusChange;

class Order extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_order'];
    public $controllerName = 'order';

    public $implement = [
        'Backend.Behaviors.ListController'
    ];
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ideas.Shop', 'shop', 'order');
    }

    public function update($recordId = null)
    {
        $this->pageTitle = 'ideas.shop::lang.action.update';
        $data['controller'] = $this->controllerName;
        $data['id'] = $recordId;
        $data['invoiceUrl'] = Backend::url('ideas/shop/order/invoice/'.$recordId);
        $order = \Ideas\Shop\Models\Order::getOrderDetail($recordId);
        $order['shipping_rule_name'] =  Ship::getShipRuleNameById($order['shipping_rule_id']);
        $data['order'] = $order;
        $data['product'] = OrderProduct::getOrderProduct($recordId);
        $orderStatusChange = OrderStatusChange::getOrderStatusChange($recordId);
        $orderStatusConvert = [];
        foreach ($orderStatusChange as $row) {
            $row['order_status_name'] = OrderStatus::getOrderStatusNameById($row['order_status_id']);
            $orderStatusConvert[] = $row;
        }
        $data['orderStatusConvert'] = $orderStatusConvert;
        $data['orderStatus'] = OrderStatus::getOrderStatus();
        $data['reason'] = Reason::getAllReason();
        $data['paid'] = IdeasShop::PAYMENT_STATUS_PAID;
        $data['notPaid'] = IdeasShop::PAYMENT_STATUS_NOT_PAID;
        $data['product_type_downloadable'] = Products::PRODUCT_TYPE_DOWNLOADABLE;
        $data['payment_status_not_paid'] = IdeasShop::PAYMENT_STATUS_NOT_PAID;
        $data['order_url'] = Backend::url('Ideas/Shop/order');
        return view('ideas.shop::order.update', $data);
    }

    public function onOrderStatusHistory()
    {
        $post = post();
        OrderStatusChange::createOrderStatusChange($post);
        $url = Backend::url('ideas/shop/order/update/'.$post['id']);
        Flash::success("You've just added an order status change");
        return redirect($url);
    }

    /**
     * Send download link downloadable product
     */
    public function onSendDownloadLink()
    {
        $post = post();
        $rs = ProductDownloadableLink::sendDownloadLink($post);
        return response()->json($rs);
    }

    /**
     * Check product in order is return
     */
    public function onCheckProductIsReturned()
    {
        $post = post();
        $rs = OrderReturn::checkProductInOrderIsReturn($post);
        return response()->json($rs);
    }

    /**
     * Create order return
     */
    public function onCreateOrderReturn()
    {
        $post = post();
        $rs = OrderReturn::createOrderReturn($post);
        return response()->json($rs);
    }

    /**
     * Change payment status
     */
    public function onChangePaymentStatus()
    {
        $post = post();
        $rs = \Ideas\Shop\Models\Order::changePaymentStatus($post);
        return response()->json($rs);
    }

    /**
     * Invoice
     * use Twig:parse() to parse view code from text get from database
     */
    public function invoice($recordId)
    {
        $this->layout = false;//disable load layout
        $order = \Ideas\Shop\Models\Order::getOrderDetail($recordId);
        $order['shipping_rule_name'] =  Ship::getShipRuleNameById($order['shipping_rule_id']);
        $order['payment_method_name'] = \Ideas\Shop\Models\Order::paymentMethodName($order['payment_method_id']);
        $data['order'] = $order;
        $data['product'] = OrderProduct::getOrderProduct($recordId);
        $data['baseUrl'] = url('/');
        $data['css'] = Config::getConfigByKey('invoice_css');
        $data['template'] = Config::getConfigByKey('invoice_template');
        $data['template_css'] = $data['css'].''.$data['template'];
        $data['now'] = date('Y-m-d', strtotime($order['created_at']));
        $data['shipping_cost'] = $order['shipping_cost'];
        $data['total'] = $order['total'];
        return Twig::parse($data['template_css'], $data);//twig parse code from string
    }

    /**
     * Invoice template
     */
    public function template()
    {
        $data['css'] = Config::getConfigByKey('invoice_css');
        $data['template'] = Config::getConfigByKey('invoice_template');
        return view('ideas.shop::order.template', $data);
    }

    /**
     * on save template
     */
    public function onSaveTemplate()
    {
        $post = post();
        $css = Config::where('slug', 'invoice_css')->first();
        $css->value = $post['invoice_css'];
        $css->save();
        $template = Config::where('slug', 'invoice_template')->first();
        $template->value = $post['invoice_template'];
        $template->save();
        $url = Backend::url('ideas/shop/order/template');
        Flash::success("You've just update invoice template");
        return redirect($url);
    }
}