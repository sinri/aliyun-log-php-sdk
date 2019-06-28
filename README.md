﻿# Aliyun Log Service PHP SDK

令和之初，为鲵苦阿里云SDK之PHP版本久矣，遂工之以魔改，使准行于PHP 5.6之环境，并置其包于Packagist，以善天下苍生。

## Release

`composer require sinri/aliyun-log-php-sdk` 

![Package](https://img.shields.io/packagist/v/sinri/aliyun-log-php-sdk.svg)

----

以下为阿里SDK介绍原文

----

## API VERSION

0.6.1

## SDK RELEASE TIME

2018-02-18

## Introduction

Log Service SDK for PHP，used to set/get log data to Aliyun Log Service(www.aliyun.com/product/sls).

API Reference: [中文](https://help.aliyun.com/document_detail/29007.html) [ENGLISH](https://www.alibabacloud.com/help/doc-detail/29007.htm)


### Summary

1. Request-Request style Restful API interface
2. Use Protocol buffer to send data 
3. Data can be compressed when sending to server
4. Aliyun_Log_Exception will be thrown if any error happen
5. Introduce simple logger for submit log easily with different levels
6. Create local log cache to submit several logs in single http post.

## Environment Requirement

1. PHP 7.1.7 and later：Master Branch
2. PHP 5.2+：[Tree v1.0](https://github.com/aliyun/aliyun-log-php-sdk/tree/v1.0)

