<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    protected $pk='goods_id';
    protected $table='goods';
    protected $fillable=['goods_name','cate_id','goods_letmnumber','goods_price','goods_img','goods_desc'];





//     function generate_goods_sn($goods_id)
// {
//     $goods_letmnumber = $GLOBALS['_CFG']['sn_prefix'] . str_repeat('0', 6 - strlen($goods_id)) . $goods_id;

//     $sql = "SELECT goods_letmnumber FROM " . $GLOBALS['ecs']->table('goods') .
//             " WHERE goods_letmnumber LIKE '" . mysql_like_quote($goods_letmnumber) . "%' AND goods_id <> '$goods_id' " .
//             " ORDER BY LENGTH(goods_letmnumber) DESC";
//     $sn_list = $GLOBALS['db']->getCol($sql);
//     if (in_array($goods_letmnumber, $sn_list))
//     {
//         $max = pow(10, strlen($sn_list[0]) - strlen($goods_letmnumber) + 1) - 1;
//         $new_sn = $goods_letmnumber . mt_rand(0, $max);
//         while (in_array($new_sn, $sn_list))
//         {
//             $new_sn = $goods_letmnumber . mt_rand(0, $max);
//         }
//         $goods_letmnumber = $new_sn;
//     }

//     return $goods_letmnumber;
// }

}
