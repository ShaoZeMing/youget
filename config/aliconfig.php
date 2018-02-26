<?php
/**
 * @author: helei
 * @createTime: 2016-07-15 17:19
 * @description:
 */

// 一下配置均为本人的沙箱环境，贡献出来，大家测试

// 个人沙箱帐号：
/*
 * 商家账号   naacvg9185@sandbox.com
 * 商户UID   2088102169252684
 * appId     2016073100130857
 */

/*
 * 买家账号    aaqlmq0729@sandbox.com
 * 登录密码    111111
 * 支付密码    111111
 */

return [
    'use_sandbox'               => true,// 是否使用沙盒模式

    'partner'                   => '2088102170274512',
    'app_id'                    => '2016080600184203',
    'sign_type'                 => 'RSA2',// RSA  RSA2

    // 可以填写文件路径，或者密钥字符串  当前字符串是 rsa2 的支付宝公钥(开放平台获取)
    'ali_public_key'            => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB',

    // 可以填写文件路径，或者密钥字符串  我的沙箱模式，rsa与rsa2的私钥相同，为了方便测试
    'rsa_private_key'           => 'MIIEpAIBAAKCAQEAr5MYmdPsbOCa/TA8Vjs6LakNyr6PjblVW0YaOHJsxXhaqgDvSsH0C6HxMe+NL8g/N8hVb0BkFJZpxhJtK2giKr9iW1KFvOQXKe4MxsVLyBW0T+Y8Mv0p6KsayMb5lEhDmJ7OBM4VlucUCbVAb4yjpRo/XU30JuSuywJqN7LkPoygAk0XFQ4Xr88DMyx+RBftp3baJR74EiRFnNmX9fg0JYPAq30+aC95AfM+8ZNzoZxtJW1jOdo3zIKntky+LEXMyBVMf3eDv7hEhLbgbJAUeNCki2XyZ/g3hXv0eJlHThDj4HzsnwDWKo1MQ77M60XtoUq4LhAf02Q4E7WxK67uxwIDAQABAoIBAGwRm3vb0NO3cE7VqN3e+NFwFBguMUgnwp06yhrie4cUrKGlj6SxO1kJpd95tqqplBfuzH983904NAUCBIZKQ3WSdaUGZ2E79/IMH3sdp6aRjXn8miM8ZtZas1LP/oFB9bF0VhTpEKrgsxnCodXHeFbAkC4LNHPYIKq+YsjD6O+CNBr4MYLbHUaA1EL1AZoN3TJVOPX+y8VDa5MSWE0QQcEMzwQ4KGe1x6vAw/gK9ebfYOoFgo5tcDzP8JaPD2NE2ckUkpA4pI9T3PurNMSQG9gGTgd8liwMT4lnkMcxbBgDVSOAh1VsikVjQxfPkWUpQJseXXlUd4Mxw4uErIR2c9ECgYEA3fY/HR2AzOCja5HmROB+ipo66oyEVcGffPCgdafpHWUa+Wts7/Hs/VaXawPS2PYIq8fNl0Z9wyQdo7s3tbcQVGXNF0I2ZtYtXtogDkDE4HKaqzJmBZXBiWNJKaD4UTjPJW9K5UOSqnJFo+cqob2XS5aJHFADx7/pg/PBbY2GOskCgYEAyn/IRDyIBIcAHanVaqkjVuDfFSORlFib4PgjGpq3ul/HOodx4CciR6vjln4CNjKvsvavlrgOSP6GOQaQj/3sg4jfAk5MiZqmay/3Y3m54B6+jpLq7xhs0Omj6Zj75pUzPenOr6V6kr6pK6oUt1/Z6mfS34a8w3TKWaugau6HFQ8CgYAaGG5ZJPPUooB0ECYraN1XvEQ6+SRB1M7EaKHk00Xj79QZCNk46I99RWXt7fgnC93/HDF+nIoCnEdjzYoCMjCYS5OuLVmqA3o4EZr9Mf4ziSXIBNfbxjyHw4WBgGxRWEV6WDhM9gHTSjYHzBDGDT0xZNRf4MRhAp4YplrSX3YtiQKBgQCFBVneEVFcf/5Afi8WqNLxIDkLHtlj9K05JGeS822bvY0XUqAomix3nl+bnV0Ak109l7USsgeYRbKQRVKzdB9o7IFqd1rpzbBimxjMvMqwgiG1cKdptsbMmZ42NmvLNdl6Y1uFoJObUCm66DhBmXKB+//XHCBl2ROPwiFX/Sa5WwKBgQDN+e6rW/y6JZKkYTy//2IUwWglcmBEfry+4bD+DTnuDxGorCFjyjw7smWc3aXzBd42mflXqz0/KQ+PyocjfAL/baGYXJUGmdGjQ1Fp/xtZUh4UqwYNtZ0QKlVaqA58NVUh/IwysIZQXntOruLUz+wdSyRs44eHusN4Et5QcLInbQ==',

    'limit_pay'                 => [
        //'balance',// 余额
        //'moneyFund',// 余额宝
        //'debitCardExpress',// 	借记卡快捷
        //'creditCard',//信用卡
        //'creditCardExpress',// 信用卡快捷
        //'creditCardCartoon',//信用卡卡通
        //'credit_group',// 信用支付类型（包含信用卡卡通、信用卡快捷、花呗、花呗分期）
    ],// 用户不可用指定渠道支付当有多个渠道时用“,”分隔

    // 与业务相关参数
//    'notify_url'                => url('api/alipay/notify'),
//    'return_url'                => url('api/alipay/notify'),

    'return_raw'                => false,// 在处理回调时，是否直接返回原始数据，默认为 true
];
