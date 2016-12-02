<?php

namespace hyperjiang;

class BankCard
{
    /**
     * 根据银行代码获取银行名称
     *
     * @param  string   $bankCode 银行代码
     * @return string
     */
    public static function getBankName($bankCode)
    {
        return \hyperjiang\BankCard\Lists::getBankName($bankCode);
    }

    /**
     * 获取卡类型名称
     *
     * @param  string   $cardType 卡类型
     * @return string
     */
    public static function getCardTypeName($cardType)
    {
        return \hyperjiang\BankCard\Types::get($cardType);
    }

    /**
     * 获取支付宝提供的银行图标
     *
     * @param  string   $bankCode 银行代码
     * @return string
     */
    public static function getBankIcon($bankCode)
    {
        return "https://apimg.alipay.com/combo.png?d=cashier&t={$bankCode}";
    }

    /**
     * 根据银行卡号获取卡信息
     *
     * @param  string  $cardNo 银行卡号
     * @return array
     */
    public static function info($cardNo)
    {
        $bankInfo = \hyperjiang\BankCard\Lists::getInfo($cardNo);

        if (empty($bankInfo)) {
            $bankInfo = self::alipay($cardNo);
        }

        return $bankInfo;
    }

    /**
     * 通过支付宝接口获取卡信息
     *
     * @param  string  $cardNo 银行卡号
     * @return array
     */
    public static function alipay($cardNo)
    {
        $result   = file_get_contents("https://ccdcapi.alipay.com/validateAndCacheCardInfo.json?_input_charset=utf-8&cardNo={$cardNo}&cardBinCheck=true");
        $result   = json_decode($result);
        $bankInfo = [];
        if ($result->validated) {
            $bankInfo = [
                'bankCode'     => $result->bank,
                'bankName'     => self::getBankName($result->bank),
                'cardType'     => $result->cardType,
                'cardTypeName' => self::getCardTypeName($result->cardType),
            ];
        }
        return $bankInfo;
    }
}
