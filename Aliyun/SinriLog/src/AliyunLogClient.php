<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

//date_default_timezone_set ( 'Asia/Shanghai' );

namespace sinri\aliyun\sls;


use Exception;
use sinri\aliyun\sls\Models\Request\ApplyConfigToMachineGroupRequest;
use sinri\aliyun\sls\Models\Request\BatchGetLogsRequest;
use sinri\aliyun\sls\Models\Request\CreateACLRequest;
use sinri\aliyun\sls\Models\Request\CreateConfigRequest;
use sinri\aliyun\sls\Models\Request\CreateLogstoreRequest;
use sinri\aliyun\sls\Models\Request\CreateMachineGroupRequest;
use sinri\aliyun\sls\Models\Request\CreateShipperRequest;
use sinri\aliyun\sls\Models\Request\DeleteACLRequest;
use sinri\aliyun\sls\Models\Request\DeleteConfigRequest;
use sinri\aliyun\sls\Models\Request\DeleteLogstoreRequest;
use sinri\aliyun\sls\Models\Request\DeleteMachineGroupRequest;
use sinri\aliyun\sls\Models\Request\DeleteShardRequest;
use sinri\aliyun\sls\Models\Request\DeleteShipperRequest;
use sinri\aliyun\sls\Models\Request\GetACLRequest;
use sinri\aliyun\sls\Models\Request\GetConfigRequest;
use sinri\aliyun\sls\Models\Request\GetCursorRequest;
use sinri\aliyun\sls\Models\Request\GetHistogramsRequest;
use sinri\aliyun\sls\Models\Request\GetLogsRequest;
use sinri\aliyun\sls\Models\Request\GetMachineGroupRequest;
use sinri\aliyun\sls\Models\Request\GetMachineRequest;
use sinri\aliyun\sls\Models\Request\GetProjectLogsRequest;
use sinri\aliyun\sls\Models\Request\GetShipperConfigRequest;
use sinri\aliyun\sls\Models\Request\GetShipperTasksRequest;
use sinri\aliyun\sls\Models\Request\ListACLsRequest;
use sinri\aliyun\sls\Models\Request\ListConfigsRequest;
use sinri\aliyun\sls\Models\Request\ListLogstoresRequest;
use sinri\aliyun\sls\Models\Request\ListMachineGroupsRequest;
use sinri\aliyun\sls\Models\Request\ListShardsRequest;
use sinri\aliyun\sls\Models\Request\ListShipperRequest;
use sinri\aliyun\sls\Models\Request\ListTopicsRequest;
use sinri\aliyun\sls\Models\Request\MergeShardsRequest;
use sinri\aliyun\sls\Models\Request\PutLogsRequest;
use sinri\aliyun\sls\Models\Request\RemoveConfigFromMachineGroupRequest;
use sinri\aliyun\sls\Models\Request\RetryShipperTasksRequest;
use sinri\aliyun\sls\Models\Request\SplitShardRequest;
use sinri\aliyun\sls\Models\Request\UpdateACLRequest;
use sinri\aliyun\sls\Models\Request\UpdateConfigRequest;
use sinri\aliyun\sls\Models\Request\UpdateLogstoreRequest;
use sinri\aliyun\sls\Models\Request\UpdateMachineGroupRequest;
use sinri\aliyun\sls\Models\Request\UpdateShipperRequest;
use sinri\aliyun\sls\Models\Response\ApplyConfigToMachineGroupResponse;
use sinri\aliyun\sls\Models\Response\BatchGetLogsResponse;
use sinri\aliyun\sls\Models\Response\CreateACLResponse;
use sinri\aliyun\sls\Models\Response\CreateConfigResponse;
use sinri\aliyun\sls\Models\Response\CreateLogstoreResponse;
use sinri\aliyun\sls\Models\Response\CreateMachineGroupResponse;
use sinri\aliyun\sls\Models\Response\CreateShipperResponse;
use sinri\aliyun\sls\Models\Response\DeleteACLResponse;
use sinri\aliyun\sls\Models\Response\DeleteConfigResponse;
use sinri\aliyun\sls\Models\Response\DeleteLogstoreResponse;
use sinri\aliyun\sls\Models\Response\DeleteMachineGroupResponse;
use sinri\aliyun\sls\Models\Response\DeleteShardResponse;
use sinri\aliyun\sls\Models\Response\DeleteShipperResponse;
use sinri\aliyun\sls\Models\Response\GetACLResponse;
use sinri\aliyun\sls\Models\Response\GetConfigResponse;
use sinri\aliyun\sls\Models\Response\GetCursorResponse;
use sinri\aliyun\sls\Models\Response\GetHistogramsResponse;
use sinri\aliyun\sls\Models\Response\GetLogsResponse;
use sinri\aliyun\sls\Models\Response\GetMachineGroupResponse;
use sinri\aliyun\sls\Models\Response\GetMachineResponse;
use sinri\aliyun\sls\Models\Response\GetShipperConfigResponse;
use sinri\aliyun\sls\Models\Response\GetShipperTasksResponse;
use sinri\aliyun\sls\Models\Response\ListACLsResponse;
use sinri\aliyun\sls\Models\Response\ListConfigsResponse;
use sinri\aliyun\sls\Models\Response\ListLogstoresResponse;
use sinri\aliyun\sls\Models\Response\ListMachineGroupsResponse;
use sinri\aliyun\sls\Models\Response\ListShardsResponse;
use sinri\aliyun\sls\Models\Response\ListShipperResponse;
use sinri\aliyun\sls\Models\Response\ListTopicsResponse;
use sinri\aliyun\sls\Models\Response\PutLogsResponse;
use sinri\aliyun\sls\Models\Response\RemoveConfigFromMachineGroupResponse;
use sinri\aliyun\sls\Models\Response\RetryShipperTasksResponse;
use sinri\aliyun\sls\Models\Response\UpdateACLResponse;
use sinri\aliyun\sls\Models\Response\UpdateConfigResponse;
use sinri\aliyun\sls\Models\Response\UpdateLogstoreResponse;
use sinri\aliyun\sls\Models\Response\UpdateMachineGroupResponse;
use sinri\aliyun\sls\Models\Response\UpdateShipperResponse;

if (!defined('API_VERSION'))
    define('API_VERSION', '0.6.0');
if (!defined('USER_AGENT'))
    define('USER_AGENT', 'log-php-sdk-v-0.6.0');

/**
 * Aliyun_Log_Client class is the main class in the SDK. It can be used to
 * communicate with LOG server to put/get data.
 *
 * @author log_dev
 */
class AliyunLogClient
{

    /**
     * @var string aliyun accessKey
     */
    protected $accessKey;

    /**
     * @var string aliyun accessKeyId
     */
    protected $accessKeyId;

    /**
     * @var string aliyun sts token
     */
    protected $stsToken;

    /**
     * @var string LOG endpoint
     */
    protected $endpoint;

    /**
     * @var string Check if the host if row ip.
     */
    protected $isRowIp;

    /**
     * @var integer Http send port. The default value is 80.
     */
    protected $port;

    /**
     * @var string log sever host.
     */
    protected $logHost;

    /**
     * @var string the local machine ip address.
     */
    protected $source;

    /**
     * Aliyun_Log_Client constructor
     *
     * @param string $endpoint
     *            LOG host name, for example, http://cn-hangzhou.sls.aliyuncs.com
     * @param string $accessKeyId
     *            aliyun accessKeyId
     * @param string $accessKey
     *            aliyun accessKey
     * @param string $token
     */
    public function __construct($endpoint, $accessKeyId, $accessKey, $token = "")
    {
        $this->setEndpoint($endpoint); // set $this->logHost
        $this->accessKeyId = $accessKeyId;
        $this->accessKey = $accessKey;
        $this->stsToken = $token;
        $this->source = AliyunLogUtil::getLocalIp();
    }

    private function setEndpoint($endpoint)
    {
        $pos = strpos($endpoint, "://");
        if ($pos !== false) { // be careful, !==
            $pos += 3;
            $endpoint = substr($endpoint, $pos);
        }
        $pos = strpos($endpoint, "/");
        if ($pos !== false) // be careful, !==
            $endpoint = substr($endpoint, 0, $pos);
        $pos = strpos($endpoint, ':');
        if ($pos !== false) { // be careful, !==
            $this->port = ( int )substr($endpoint, $pos + 1);
            $endpoint = substr($endpoint, 0, $pos);
        } else
            $this->port = 80;
        $this->isRowIp = AliyunLogUtil::isIp($endpoint);
        $this->logHost = $endpoint;
        $this->endpoint = $endpoint . ':' . ( string )$this->port;
    }

    /**
     * GMT format time string.
     *
     * @return string
     */
    protected function getGMT()
    {
        return gmdate('D, d M Y H:i:s') . ' GMT';
    }


    /**
     * Decodes a JSON string to a JSON Object.
     * Unsuccessful decode will cause an AliyunLogException.
     *
     * @param $resBody
     * @param $requestId
     * @return array
     * @throws AliyunLogException
     */
    protected function parseToJson($resBody, $requestId)
    {
        if (!$resBody)
            return NULL;

        $result = json_decode($resBody, true);
        if ($result === NULL) {
            throw new AliyunLogException ('BadResponse', "Bad format,not json: $resBody", $requestId);
        }
        return $result;
    }

    /**
     * @param $method
     * @param $url
     * @param $body
     * @param $headers
     * @return array
     * @throws RequestCoreException
     * @throws RequestCoreException
     */
    protected function getHttpResponse($method, $url, $body, $headers)
    {
        $request = new RequestCore ($url);
        foreach ($headers as $key => $value)
            $request->add_header($key, $value);
        $request->set_method($method);
        $request->set_useragent(USER_AGENT);
        if ($method == "POST" || $method == "PUT")
            $request->set_body($body);
        $request->send_request();
        $response = array();
        $response [] = ( int )$request->get_response_code();
        $response [] = $request->get_response_header();
        $response [] = $request->get_response_body();
        return $response;
    }

    /**
     * @param $method
     * @param $url
     * @param $body
     * @param $headers
     * @return array
     * @throws AliyunLogException
     */
    private function sendRequest($method, $url, $body, $headers)
    {
        try {
            list ($responseCode, $header, $resBody) =
                $this->getHttpResponse($method, $url, $body, $headers);
        } catch (Exception $ex) {
            throw new AliyunLogException ($ex->getMessage(), $ex->__toString());
        }

        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';

        if ($responseCode == 200) {
            return array($resBody, $header);
        } else {
            $exJson = $this->parseToJson($resBody, $requestId);
            if (isset($exJson ['error_code']) && isset($exJson ['error_message'])) {
                throw new AliyunLogException ($exJson ['error_code'],
                    $exJson ['error_message'], $requestId);
            } else {
                if ($exJson) {
                    $exJson = ' The return json is ' . json_encode($exJson);
                } else {
                    $exJson = '';
                }
                throw new AliyunLogException ('RequestError',
                    "Request is failed. Http code is $responseCode.$exJson", $requestId);
            }
        }
    }

    /**
     * @param $method
     * @param $project
     * @param $body
     * @param $resource
     * @param $params
     * @param $headers
     * @return array
     * @throws AliyunLogException
     */
    private function send($method, $project, $body, $resource, $params, $headers)
    {
        if ($body) {
            $headers ['Content-Length'] = strlen($body);
            if (isset($headers ["x-log-bodyrawsize"]) == false)
                $headers ["x-log-bodyrawsize"] = 0;
            $headers ['Content-MD5'] = AliyunLogUtil::calMD5($body);
        } else {
            $headers ['Content-Length'] = 0;
            $headers ["x-log-bodyrawsize"] = 0;
            $headers ['Content-Type'] = ''; // If not set, http request will add automatically.
        }

        $headers ['x-log-apiversion'] = API_VERSION;
        $headers ['x-log-signaturemethod'] = 'hmac-sha1';
        if (strlen($this->stsToken) > 0)
            $headers ['x-acs-security-token'] = $this->stsToken;
        if (is_null($project)) $headers ['Host'] = $this->logHost;
        else $headers ['Host'] = "$project.$this->logHost";
        $headers ['Date'] = $this->GetGMT();
        $signature = AliyunLogUtil::getRequestAuthorization($method, $resource, $this->accessKey, $this->stsToken, $params, $headers);
        $headers ['Authorization'] = "LOG $this->accessKeyId:$signature";

        $url = $resource;
        if ($params)
            $url .= '?' . AliyunLogUtil::urlEncode($params);
        if ($this->isRowIp)
            $url = "http://$this->endpoint$url";
        else {
            if (is_null($project))
                $url = "http://$this->endpoint$url";
            else  $url = "http://$project.$this->endpoint$url";
        }
        return $this->sendRequest($method, $url, $body, $headers);
    }

    /**
     * Put logs to Log Service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param PutLogsRequest $request the PutLogs request parameters class
     * @return PutLogsResponse
     * @throws Exception
     * @throws AliyunLogException
     */
    public function putLogs(PutLogsRequest $request)
    {
        if (count($request->getLogitems()) > 4096)
            throw new AliyunLogException ('InvalidLogSize', "logItems' length exceeds maximum limitation: 4096 lines.");

        $logGroup = new SLSProtocolLogGroup ();
        $topic = $request->getTopic() !== null ? $request->getTopic() : '';
        $logGroup->setTopic($topic);
        $source = $request->getSource();

        if (!$source)
            $source = $this->source;
        $logGroup->setSource($source);
        $logItems = $request->getLogitems();
        foreach ($logItems as $logItem) {
            $log = new SLSProtocolLog();
            $log->setTime($logItem->getTime());
            $content = $logItem->getContents();
            foreach ($content as $key => $value) {
                $content = new SLSProtocolLogContent();
                $content->setKey($key);
                $content->setValue($value);
                $log->addContents($content);
            }

            $logGroup->addLogs($log);
        }

        $body = AliyunLogUtil::toBytes($logGroup);
        unset ($logGroup);

        $bodySize = strlen($body);
        if ($bodySize > 3 * 1024 * 1024) // 3 MB
            throw new AliyunLogException ('InvalidLogSize', "logItems' size exceeds maximum limitation: 3 MB.");
        $params = array();
        $headers = array();
        $headers ["x-log-bodyrawsize"] = $bodySize;
        $headers ['x-log-compresstype'] = 'deflate';
        $headers ['Content-Type'] = 'application/x-protobuf';
        $body = gzcompress($body, 6);

        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $shardKey = $request->getShardKey();
        $resource = "/logstores/" . $logstore . ($shardKey == null ? "/shards/lb" : "/shards/route");
        if ($shardKey)
            $params["key"] = $shardKey;
        list ($resp, $header) = $this->send("POST", $project, $body, $resource, $params, $headers);
//        $requestId = isset ( $header ['x-log-requestid'] ) ? $header ['x-log-requestid'] : '';
//        $resp = $this->parseToJson ( $resp, $requestId ); // no use
        return new PutLogsResponse ($header);
    }

    /**
     * create shipper service
     * @param CreateShipperRequest $request
     * @return CreateShipperResponse
     * @throws AliyunLogException
     */
    public function createShipper(CreateShipperRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = "/logstores/" . $request->getLogStore() . "/shipper";
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["Content-Type"] = "application/json";

        $body = array(
            "shipperName" => $request->getShipperName(),
            "targetType" => $request->getTargetType(),
            "targetConfiguration" => $request->getTargetConfiguration()
        );
        $body_str = json_encode($body);
        $headers["x-log-bodyrawsize"] = strlen($body_str);
        list($resp, $header) = $this->send("POST", $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateShipperResponse($resp, $header);
    }

    /**
     * create shipper service
     * @param UpdateShipperRequest $request
     * return UpdateShipperResponse
     * @return UpdateShipperResponse
     * @throws AliyunLogException
     */
    public function updateShipper(UpdateShipperRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = "/logstores/" . $request->getLogStore() . "/shipper/" . $request->getShipperName();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["Content-Type"] = "application/json";

        $body = array(
            "shipperName" => $request->getShipperName(),
            "targetType" => $request->getTargetType(),
            "targetConfiguration" => $request->getTargetConfiguration()
        );
        $body_str = json_encode($body);
        $headers["x-log-bodyrawsize"] = strlen($body_str);
        list($resp, $header) = $this->send("PUT", $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new UpdateShipperResponse($resp, $header);
    }

    /**
     * get shipper tasks list, max 48 hours duration supported
     * @param GetShipperTasksRequest $request
     * @return GetShipperTasksResponse
     * @throws AliyunLogException
     */
    public function getShipperTasks(GetShipperTasksRequest $request)
    {
        $headers = array();
        $params = array(
            'from' => $request->getStartTime(),
            'to' => $request->getEndTime(),
            'status' => $request->getStatusType(),
            'offset' => $request->getOffset(),
            'size' => $request->getSize()
        );
        $resource = "/logstores/" . $request->getLogStore() . "/shipper/" . $request->getShipperName() . "/tasks";
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["x-log-bodyrawsize"] = 0;
        $headers["Content-Type"] = "application/json";

        list($resp, $header) = $this->send("GET", $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetShipperTasksResponse($resp, $header);
    }

    /**
     * retry shipper tasks list by task ids
     * @param RetryShipperTasksRequest $request
     * @return RetryShipperTasksResponse
     * @throws AliyunLogException
     */
    public function retryShipperTasks(RetryShipperTasksRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = "/logstores/" . $request->getLogStore() . "/shipper/" . $request->getShipperName() . "/tasks";
        $project = $request->getProject() !== null ? $request->getProject() : '';

        $headers["Content-Type"] = "application/json";
        $body = $request->getTaskLists();
        $body_str = json_encode($body);
        $headers["x-log-bodyrawsize"] = strlen($body_str);
        list($resp, $header) = $this->send("PUT", $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new RetryShipperTasksResponse($resp, $header);
    }

    /**
     * delete shipper service
     * @param DeleteShipperRequest $request
     * @return DeleteShipperResponse
     * @throws AliyunLogException
     */
    public function deleteShipper(DeleteShipperRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = "/logstores/" . $request->getLogStore() . "/shipper/" . $request->getShipperName();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["x-log-bodyrawsize"] = 0;
        $headers["Content-Type"] = "application/json";

        list($resp, $header) = $this->send("DELETE", $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new DeleteShipperResponse($resp, $header);
    }

    /**
     * get shipper config service
     * @param GetShipperConfigRequest $request
     * @return GetShipperConfigResponse
     * @throws AliyunLogException
     */
    public function getShipperConfig(GetShipperConfigRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = "/logstores/" . $request->getLogStore() . "/shipper/" . $request->getShipperName();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["x-log-bodyrawsize"] = 0;
        $headers["Content-Type"] = "application/json";

        list($resp, $header) = $this->send("GET", $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetShipperConfigResponse($resp, $header);
    }

    /**
     * list shipper service
     * @param ListShipperRequest $request
     * @return ListShipperResponse
     * @throws AliyunLogException
     */
    public function listShipper(ListShipperRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = "/logstores/" . $request->getLogStore() . "/shipper";
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["x-log-bodyrawsize"] = 0;
        $headers["Content-Type"] = "application/json";

        list($resp, $header) = $this->send("GET", $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShipperResponse($resp, $header);
    }

    /**
     * create logstore
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param CreateLogstoreRequest $request the CreateLogStore request parameters class.
     * @return CreateLogstoreResponse
     * @throws AliyunLogException
     */
    public function createLogstore(CreateLogstoreRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = '/logstores';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["x-log-bodyrawsize"] = 0;
        $headers["Content-Type"] = "application/json";
        $body = array(
            "logstoreName" => $request->getLogstore(),
            "ttl" => (int)($request->getTtl()),
            "shardCount" => (int)($request->getShardCount())
        );
        $body_str = json_encode($body);
        $headers["x-log-bodyrawsize"] = strlen($body_str);
        list($resp, $header) = $this->send("POST", $project, $body_str, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateLogstoreResponse($resp, $header);
    }

    /**
     * update logstore
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param UpdateLogstoreRequest $request the UpdateLogStore request parameters class.
     * @return UpdateLogstoreResponse
     * @throws AliyunLogException
     */
    public function updateLogstore(UpdateLogstoreRequest $request)
    {
        $headers = array();
        $params = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers["Content-Type"] = "application/json";
        $body = array(
            "logstoreName" => $request->getLogstore(),
            "ttl" => (int)($request->getTtl()),
            "shardCount" => (int)($request->getShardCount())
        );
        $resource = '/logstores/' . $request->getLogstore();
        $body_str = json_encode($body);
        $headers["x-log-bodyrawsize"] = strlen($body_str);
        list($resp, $header) = $this->send("PUT", $project, $body_str, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new UpdateLogstoreResponse($resp, $header);
    }

    /**
     * List all logstores of requested project.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param ListLogstoresRequest $request the ListLogstores request parameters class.
     * @return ListLogstoresResponse
     * @throws AliyunLogException
     */
    public function listLogstores(ListLogstoresRequest $request)
    {
        $headers = array();
        $params = array();
        $resource = '/logstores';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        list ($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListLogstoresResponse ($resp, $header);
    }

    /**
     * Delete logstore
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param DeleteLogstoreRequest $request the DeleteLogstores request parameters class.
     * @return DeleteLogstoreResponse
     * @throws AliyunLogException
     */
    public function deleteLogstore(DeleteLogstoreRequest $request)
    {
        $headers = array();
        $params = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() != null ? $request->getLogstore() : "";
        $resource = "/logstores/$logstore";
        list ($resp, $header) = $this->send("DELETE", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new DeleteLogstoreResponse ($resp, $header);
    }

    /**
     * List all topics in a logstore.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param ListTopicsRequest $request the ListTopics request parameters class.
     * @return ListTopicsResponse
     * @throws AliyunLogException
     */
    public function listTopics(ListTopicsRequest $request)
    {
        $headers = array();
        $params = array();
        if ($request->getToken() !== null)
            $params ['token'] = $request->getToken();
        if ($request->getLine() !== null)
            $params ['line'] = $request->getLine();
        $params ['type'] = 'topic';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/$logstore";
        list ($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListTopicsResponse ($resp, $header);
    }

    /**
     * Get histograms of requested query from log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetHistogramsRequest $request the GetHistograms request parameters class.
     * @return array (json body, http header)
     * @throws AliyunLogException
     */
    public function getHistogramsJson(GetHistogramsRequest $request)
    {
        $headers = array();
        $params = array();
        if ($request->getTopic() !== null)
            $params ['topic'] = $request->getTopic();
        if ($request->getFrom() !== null)
            $params ['from'] = $request->getFrom();
        if ($request->getTo() !== null)
            $params ['to'] = $request->getTo();
        if ($request->getQuery() !== null)
            $params ['query'] = $request->getQuery();
        $params ['type'] = 'histogram';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/$logstore";
        list ($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return array($resp, $header);
    }

    /**
     * Get histograms of requested query from log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetHistogramsRequest $request the GetHistograms request parameters class.
     * @return GetHistogramsResponse
     * @throws AliyunLogException
     */
    public function getHistograms(GetHistogramsRequest $request)
    {
        $ret = $this->getHistogramsJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new GetHistogramsResponse ($resp, $header);
    }

    /**
     * Get logs from Log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetLogsRequest $request the GetLogs request parameters class.
     * @return array(json body, http header)
     * @throws AliyunLogException
     */
    public function getLogsJson(GetLogsRequest $request)
    {
        $headers = array();
        $params = array();
        if ($request->getTopic() !== null)
            $params ['topic'] = $request->getTopic();
        if ($request->getFrom() !== null)
            $params ['from'] = $request->getFrom();
        if ($request->getTo() !== null)
            $params ['to'] = $request->getTo();
        if ($request->getQuery() !== null)
            $params ['query'] = $request->getQuery();
        $params ['type'] = 'log';
        if ($request->getLine() !== null)
            $params ['line'] = $request->getLine();
        if ($request->getOffset() !== null)
            $params ['offset'] = $request->getOffset();
        if ($request->getOffset() !== null)
            $params ['reverse'] = $request->getReverse() ? 'true' : 'false';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/$logstore";
        list ($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return array($resp, $header);
        //return new GetLogsResponse ( $resp, $header );
    }

    /**
     * Get logs from Log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetLogsRequest $request the GetLogs request parameters class.
     * @return GetLogsResponse
     * @throws AliyunLogException
     */
    public function getLogs(GetLogsRequest $request)
    {
        $ret = $this->getLogsJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new GetLogsResponse ($resp, $header);
    }

    /**
     * Get logs from Log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetProjectLogsRequest $request the GetLogs request parameters class.
     * @return array(json body, http header)
     * @throws AliyunLogException
     */
    public function getProjectLogsJson(GetProjectLogsRequest $request)
    {
        $headers = array();
        $params = array();
        if ($request->getQuery() !== null)
            $params ['query'] = $request->getQuery();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logs";
        list ($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return array($resp, $header);
        //return new GetLogsResponse ( $resp, $header );
    }

    /**
     * Get logs from Log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetProjectLogsRequest $request the GetLogs request parameters class.
     * @return GetLogsResponse
     * @throws AliyunLogException
     */
    public function getProjectLogs(GetProjectLogsRequest $request)
    {
        $ret = $this->getProjectLogsJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new GetLogsResponse ($resp, $header);
    }

    /**
     * Get logs from Log service with ShardId conditions.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param BatchGetLogsRequest $request the BatchGetLogs request parameters class.
     * @return BatchGetLogsResponse
     * @throws Exception
     * @throws AliyunLogException
     */
    public function batchGetLogs(BatchGetLogsRequest $request)
    {
        $params = array();
        $headers = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() !== null ? $request->getShardId() : '';
        if ($request->getCount() !== null)
            $params['count'] = $request->getCount();
        if ($request->getCursor() !== null)
            $params['cursor'] = $request->getCursor();
        if ($request->getEndCursor() !== null)
            $params['end_cursor'] = $request->getEndCursor();
        $params['type'] = 'log';
        $headers['Accept-Encoding'] = 'gzip';
        $headers['accept'] = 'application/x-protobuf';

        $resource = "/logstores/$logstore/shards/$shardId";
        list($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        //$resp is a byteArray
        $resp = gzuncompress($resp);
        if ($resp === false) $resp = new SLSProtocolLogGroupList();

        else {
            $resp = new SLSProtocolLogGroupList($resp);
        }
        return new BatchGetLogsResponse ($resp, $header);
    }

    /**
     * List Shards from Log service with Project and logstore conditions.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param ListShardsRequest $request the ListShards request parameters class.
     * @return ListShardsResponse
     * @throws AliyunLogException
     */
    public function listShards(ListShardsRequest $request)
    {
        $params = array();
        $headers = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';

        $resource = '/logstores/' . $logstore . '/shards';
        list($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShardsResponse ($resp, $header);
    }

    /**
     * split a shard into two shards  with Project and logstore and shardId and midHash conditions.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param SplitShardRequest $request the SplitShard request parameters class.
     * @return ListShardsResponse
     * @throws AliyunLogException
     */
    public function splitShard(SplitShardRequest $request)
    {
        $params = array();
        $headers = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() !== null ? $request->getShardId() : -1;
        $midHash = $request->getMidHash() != null ? $request->getMidHash() : "";

        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        $params["action"] = "split";
        $params["key"] = $midHash;
        list($resp, $header) = $this->send("POST", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShardsResponse ($resp, $header);
    }

    /**
     * merge two shards into one shard with Project and logstore and shardId and conditions.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param MergeShardsRequest $request the MergeShards request parameters class.
     * @return ListShardsResponse
     * @throws AliyunLogException
     */
    public function MergeShards(MergeShardsRequest $request)
    {
        $params = array();
        $headers = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() != null ? $request->getShardId() : -1;

        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        $params["action"] = "merge";
        list($resp, $header) = $this->send("POST", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShardsResponse ($resp, $header);
    }

    /**
     * delete a read only shard with Project and logstore and shardId conditions.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param DeleteShardRequest $request the DeleteShard request parameters class.
     * @return DeleteShardResponse
     * @throws AliyunLogException
     */
    public function DeleteShard(DeleteShardRequest $request)
    {
        $params = array();
        $headers = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() != null ? $request->getShardId() : -1;

        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        list($resp, $header) = $this->send("DELETE", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        return new DeleteShardResponse ($header);
    }

    /**
     * Get cursor from Log service.
     * Unsuccessful operation will cause an AliyunLogException.
     *
     * @param GetCursorRequest $request the GetCursor request parameters class.
     * @return GetCursorResponse
     * @throws AliyunLogException
     */
    public function getCursor(GetCursorRequest $request)
    {
        $params = array();
        $headers = array();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() !== null ? $request->getShardId() : '';
        $mode = $request->getMode() !== null ? $request->getMode() : '';
        $fromTime = $request->getFromTime() !== null ? $request->getFromTime() : -1;

        if ((empty($mode) xor $fromTime == -1) == false) {
            if (!empty($mode))
                throw new AliyunLogException ('RequestError', "Request is failed. Mode and fromTime can not be not empty simultaneously");
            else
                throw new AliyunLogException ('RequestError', "Request is failed. Mode and fromTime can not be empty simultaneously");
        }
        if (!empty($mode) && strcmp($mode, 'begin') !== 0 && strcmp($mode, 'end') !== 0)
            throw new AliyunLogException ('RequestError', "Request is failed. Mode value invalid:$mode");
        if ($fromTime !== -1 && (is_integer($fromTime) == false || $fromTime < 0))
            throw new AliyunLogException ('RequestError', "Request is failed. FromTime value invalid:$fromTime");
        $params['type'] = 'cursor';
        if ($fromTime !== -1) $params['from'] = $fromTime;
        else $params['mode'] = $mode;
        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        list($resp, $header) = $this->send("GET", $project, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetCursorResponse($resp, $header);
    }

    /**
     * @param CreateConfigRequest $request
     * @return CreateConfigResponse
     * @throws AliyunLogException
     */
    public function createConfig(CreateConfigRequest $request)
    {
        $params = array();
        $headers = array();
        $body = null;
        if ($request->getConfig() !== null) {
            $body = json_encode($request->getConfig()->toArray());
        }
        $headers ['Content-Type'] = 'application/json';
        $resource = '/configs';
        list($resp, $header) = $this->send("POST", NULL, $body, $resource, $params, $headers);
        return new CreateConfigResponse($header);
    }

    /**
     * @param UpdateConfigRequest $request
     * @return UpdateConfigResponse
     * @throws AliyunLogException
     */
    public function updateConfig(UpdateConfigRequest $request)
    {
        $params = array();
        $headers = array();
        $body = null;
        $configName = '';
        if ($request->getConfig() !== null) {
            $body = json_encode($request->getConfig()->toArray());
            $configName = ($request->getConfig()->getConfigName() !== null) ? $request->getConfig()->getConfigName() : '';
        }
        $headers ['Content-Type'] = 'application/json';
        $resource = '/configs/' . $configName;
        list($resp, $header) = $this->send("PUT", NULL, $body, $resource, $params, $headers);
        return new UpdateConfigResponse($header);
    }

    /**
     * @param GetConfigRequest $request
     * @return GetConfigResponse
     * @throws AliyunLogException
     */
    public function getConfig(GetConfigRequest $request)
    {
        $params = array();
        $headers = array();

        $configName = ($request->getConfigName() !== null) ? $request->getConfigName() : '';

        $resource = '/configs/' . $configName;
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetConfigResponse($resp, $header);
    }

    /**
     * @param DeleteConfigRequest $request
     * @return DeleteConfigResponse
     * @throws AliyunLogException
     */
    public function deleteConfig(DeleteConfigRequest $request)
    {
        $params = array();
        $headers = array();
        $configName = ($request->getConfigName() !== null) ? $request->getConfigName() : '';
        $resource = '/configs/' . $configName;
        list($resp, $header) = $this->send("DELETE", NULL, NULL, $resource, $params, $headers);
        return new DeleteConfigResponse($header);
    }

    /**
     * @param ListConfigsRequest $request
     * @return ListConfigsResponse
     * @throws AliyunLogException
     */
    public function listConfigs(ListConfigsRequest $request)
    {
        $params = array();
        $headers = array();

        if ($request->getConfigName() !== null) $params['configName'] = $request->getConfigName();
        if ($request->getOffset() !== null) $params['offset'] = $request->getOffset();
        if ($request->getSize() !== null) $params['size'] = $request->getSize();

        $resource = '/configs';
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListConfigsResponse($resp, $header);
    }

    /**
     * @param CreateMachineGroupRequest $request
     * @return CreateMachineGroupResponse
     * @throws AliyunLogException
     */
    public function createMachineGroup(CreateMachineGroupRequest $request)
    {
        $params = array();
        $headers = array();
        $body = null;
        if ($request->getMachineGroup() !== null) {
            $body = json_encode($request->getMachineGroup()->toArray());
        }
        $headers ['Content-Type'] = 'application/json';
        $resource = '/machinegroups';
        list($resp, $header) = $this->send("POST", NULL, $body, $resource, $params, $headers);

        return new CreateMachineGroupResponse($header);
    }

    /**
     * @param UpdateMachineGroupRequest $request
     * @return UpdateMachineGroupResponse
     * @throws AliyunLogException
     */
    public function updateMachineGroup(UpdateMachineGroupRequest $request)
    {
        $params = array();
        $headers = array();
        $body = null;
        $groupName = '';
        if ($request->getMachineGroup() !== null) {
            $body = json_encode($request->getMachineGroup()->toArray());
            $groupName = ($request->getMachineGroup()->getGroupName() !== null) ? $request->getMachineGroup()->getGroupName() : '';
        }
        $headers ['Content-Type'] = 'application/json';
        $resource = '/machinegroups/' . $groupName;
        list($resp, $header) = $this->send("PUT", NULL, $body, $resource, $params, $headers);
        return new UpdateMachineGroupResponse($header);
    }

    /**
     * @param GetMachineGroupRequest $request
     * @return GetMachineGroupResponse
     * @throws AliyunLogException
     */
    public function getMachineGroup(GetMachineGroupRequest $request)
    {
        $params = array();
        $headers = array();

        $groupName = ($request->getGroupName() !== null) ? $request->getGroupName() : '';

        $resource = '/machinegroups/' . $groupName;
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetMachineGroupResponse($resp, $header);
    }

    /**
     * @param DeleteMachineGroupRequest $request
     * @return DeleteMachineGroupResponse
     * @throws AliyunLogException
     */
    public function deleteMachineGroup(DeleteMachineGroupRequest $request)
    {
        $params = array();
        $headers = array();

        $groupName = ($request->getGroupName() !== null) ? $request->getGroupName() : '';
        $resource = '/machinegroups/' . $groupName;
        list($resp, $header) = $this->send("DELETE", NULL, NULL, $resource, $params, $headers);
        return new DeleteMachineGroupResponse($header);
    }

    /**
     * @param ListMachineGroupsRequest $request
     * @return ListMachineGroupsResponse
     * @throws AliyunLogException
     */
    public function listMachineGroups(ListMachineGroupsRequest $request)
    {
        $params = array();
        $headers = array();

        if ($request->getGroupName() !== null) $params['groupName'] = $request->getGroupName();
        if ($request->getOffset() !== null) $params['offset'] = $request->getOffset();
        if ($request->getSize() !== null) $params['size'] = $request->getSize();

        $resource = '/machinegroups';
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);

        return new ListMachineGroupsResponse($resp, $header);
    }

    /**
     * @param ApplyConfigToMachineGroupRequest $request
     * @return ApplyConfigToMachineGroupResponse
     * @throws AliyunLogException
     */
    public function applyConfigToMachineGroup(ApplyConfigToMachineGroupRequest $request)
    {
        $params = array();
        $headers = array();
        $configName = $request->getConfigName();
        $groupName = $request->getGroupName();
        $headers ['Content-Type'] = 'application/json';
        $resource = '/machinegroups/' . $groupName . '/configs/' . $configName;
        list($resp, $header) = $this->send("PUT", NULL, NULL, $resource, $params, $headers);
        return new ApplyConfigToMachineGroupResponse($header);
    }

    /**
     * @param RemoveConfigFromMachineGroupRequest $request
     * @return RemoveConfigFromMachineGroupResponse
     * @throws AliyunLogException
     */
    public function removeConfigFromMachineGroup(RemoveConfigFromMachineGroupRequest $request)
    {
        $params = array();
        $headers = array();
        $configName = $request->getConfigName();
        $groupName = $request->getGroupName();
        $headers ['Content-Type'] = 'application/json';
        $resource = '/machinegroups/' . $groupName . '/configs/' . $configName;
        list($resp, $header) = $this->send("DELETE", NULL, NULL, $resource, $params, $headers);
        return new RemoveConfigFromMachineGroupResponse($header);
    }

    /**
     * @param GetMachineRequest $request
     * @return GetMachineResponse
     * @throws AliyunLogException
     */
    public function getMachine(GetMachineRequest $request)
    {
        $params = array();
        $headers = array();

        $uuid = ($request->getUuid() !== null) ? $request->getUuid() : '';

        $resource = '/machines/' . $uuid;
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetMachineResponse($resp, $header);
    }

    /**
     * @param CreateACLRequest $request
     * @return CreateACLResponse
     * @throws AliyunLogException
     */
    public function createACL(CreateACLRequest $request)
    {
        $params = array();
        $headers = array();
        $body = null;
        if ($request->getAcl() !== null) {
            $body = json_encode($request->getAcl()->toArray());
        }
        $headers ['Content-Type'] = 'application/json';
        $resource = '/acls';
        list($resp, $header) = $this->send("POST", NULL, $body, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateACLResponse($resp, $header);
    }

    /**
     * @param UpdateACLRequest $request
     * @return UpdateACLResponse
     * @throws AliyunLogException
     */
    public function updateACL(UpdateACLRequest $request)
    {
        $params = array();
        $headers = array();
        $body = null;
        $aclId = '';
        if ($request->getAcl() !== null) {
            $body = json_encode($request->getAcl()->toArray());
            $aclId = ($request->getAcl()->getAclId() !== null) ? $request->getAcl()->getAclId() : '';
        }
        $headers ['Content-Type'] = 'application/json';
        $resource = '/acls/' . $aclId;
        list($resp, $header) = $this->send("PUT", NULL, $body, $resource, $params, $headers);
        return new UpdateACLResponse($header);
    }

    /**
     * @param GetACLRequest $request
     * @return GetACLResponse
     * @throws AliyunLogException
     */
    public function getACL(GetACLRequest $request)
    {
        $params = array();
        $headers = array();

        $aclId = ($request->getAclId() !== null) ? $request->getAclId() : '';

        $resource = '/acls/' . $aclId;
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);

        return new GetACLResponse($resp, $header);
    }

    /**
     * @param DeleteACLRequest $request
     * @return DeleteACLResponse
     * @throws AliyunLogException
     */
    public function deleteACL(DeleteACLRequest $request)
    {
        $params = array();
        $headers = array();
        $aclId = ($request->getAclId() !== null) ? $request->getAclId() : '';
        $resource = '/acls/' . $aclId;
        list($resp, $header) = $this->send("DELETE", NULL, NULL, $resource, $params, $headers);
        return new DeleteACLResponse($header);
    }

    /**
     * @param ListACLsRequest $request
     * @return ListACLsResponse
     * @throws AliyunLogException
     */
    public function listACLs(ListACLsRequest $request)
    {
        $params = array();
        $headers = array();
        if ($request->getPrincipleId() !== null) $params['principleId'] = $request->getPrincipleId();
        if ($request->getOffset() !== null) $params['offset'] = $request->getOffset();
        if ($request->getSize() !== null) $params['size'] = $request->getSize();

        $resource = '/acls';
        list($resp, $header) = $this->send("GET", NULL, NULL, $resource, $params, $headers);
        $requestId = isset ($header ['x-log-requestid']) ? $header ['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListACLsResponse($resp, $header);
    }

}

