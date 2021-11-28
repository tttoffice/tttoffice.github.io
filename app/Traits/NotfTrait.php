<?php

namespace App\Traits;


trait NotfTrait
{

    public function create_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.order.create');
        $content = __('notf.order.create2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function client_canceled_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.kitchen.canceled');
        $content = __('notf.kitchen.canceled2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function kitchen_accept_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.kitchen.accept');
        $content = __('notf.kitchen.accept2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function kitchen_canceled_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.kitchen.canceled');
        $content = __('notf.kitchen.canceled2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function kitchen_setdeliverer_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.kitchen.setdeliverer');
        $content = __('notf.kitchen.setdeliverer2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function deliverer_canceled_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.deliverer.canceled');
        $content = __('notf.deliverer.canceled2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function deliverer_ongoing_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.deliverer.ongoing');
        $content = __('notf.deliverer.ongoing2') . " ( $order_id )";
        return $this->send_notf($title, $content, $order_id, $model, $model_id);
    }

    public function deliverer_delivered_notf($order_id, $model, $model_id)
    {
        $title =  __('notf.deliverer.delivered');
        $content = __('notf.deliverer.delivered2') . " ( $order_id )";
        return  $this->send_notf($title, $content, $order_id, $model, $model_id);
    }



    public function send_notf($title, $content,$order_id, $model, $model_id)
    {
        $data = [
            "activity" => "order",
            "id" =>  "$order_id",
        ];

        // info("firebase result: " .$title. " ". $content. " ". $order_id. " ". $model. " ". $model_id);

        return notifyByFirebase($title, $content, [gettoken($model, $model_id)], $data);
    }



}
