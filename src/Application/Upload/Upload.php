<?php


namespace Application\Upload;


/**
 * 上传类
 * Class Upload
 * @package Application\Upload
 */
class Upload
{
    public string $token = "";       # 上传验证口令
    public string $from_name = "";   # 文件表单name值
    public array $ext = array();     # 允许上传文件的后缀(一维的索引数组)
    public int $size = 0;            # 允许上传文件的大小(int)
    public array $mime = array();    # 允许上传文件的MIME(一维的索引数组)
    public string $host = "";        # 文件访问域名

    /**
     * 文件接收入口 - 单文件、多文件上传
     * @param String $fromName 提交表单name
     */
    public function __construct($fromName = 'file')
    {
        $this->from_name = $fromName;
    }

    /**
     * 设置上传口令 token
     * @param string $token
     * @return Upload
     */
    public function token($token = ""): Upload
    {
        $this->token = $token;
        return $this;
    }

    /**
     * 文件接收入口
     * @param string $storage 文件存储路径
     * @param string $allow 允许上传文件规则 ['ext'=>'后缀名限制','size'=>193038] = ['ext'=>'png,jpg,gif','size'=>193038]
     * @param string $host 文件访问域名
     * @return array 结果
     */
    public function save($storage = "", $allow = "", $host = ""): array
    {
        /** token 验证 */
        if ($this->token != "") {
            if (!isset($_POST['token']) || $_POST['token'] != $this->token) {
                return array(
                    'status' => false,
                    'msg' => "token验证错误"
                );
            }
        }

        /** 存储路径合法判断 */
        if (empty($storage) || !is_string($storage)) {

            return array(
                'status' => false,
                'msg' => "文件存储路径不合法"
            );

        }

        /** 初始化过滤设置, 如果$allow为字符串型时自动设置 $host = $allow */
        if (is_string($allow)) {
            $host = $allow;
        } else {
            $this->allow($allow);
        }

        /** 初始化文件访问域名 */
        if ($host == "") {
            $this->host = 'http://' . $_SERVER['HTTP_HOST'];
        } else {
            $this->host = preg_match('/^http[s]?\:\/\//', $host) ? $host : 'http://' . $host;
        }

        if (!empty($_FILES) && isset($_FILES[$this->from_name])) {
            /** 判断存储目录是否存在,无则自动创建 */
            if (!is_dir($storage)) {
                /** 创建目录 */
                mkdir($storage, '0777', true);
                /**  改变文件模式 */
                chmod($storage, 0777);
            }

            /** 上传文件存储目录的绝对路径 */
            $savePath = realpath($storage);

            /** 文件数组 */
            $fileList = array();

            /** 简化数组 */
            $files = $_FILES[$this->from_name];
            if (is_string($files['name'])) {
                /** 单文件上传 */
                $checkRes = $this->fileCheck($files);
                if ($checkRes['status']) {
                    /** 校检没问题  获取图片相关信息*/
                    $fileList[] = $files;
                } else {
                    /** 不通过 文件 */
                    return $checkRes;
                }
            }
            /** 从临时空间里提取出文件到真实路径、文件信息补全 */
            $newArr = array();
            if (count($fileList) == 1) {
                /** 文件后缀名 */
                $ext = $this->getFileExt($fileList[0]['name']);
                $fileName = $ext == '' ? $this->uuid() : $this->uuid() . '.' . $ext;
                /** 移动位置 */
                move_uploaded_file($fileList[0]['tmp_name'], $savePath . '/' . $fileName);

                /** 上传文件回调数据信息 */
                $newArr['name'] = $fileList[0]['name']; # 文件上传时的原名称
                /** 文件后缀名 */
                $newArr['ext'] = $ext;
                /** 文件MIME */
                $newArr['mime'] = $fileList[0]['type'];
                /** 文件大小(单位:字节) */
                $newArr['size'] = $fileList[0]['size'];
                /** 文件保存在服务器上名称 */
                $newArr['saveName'] = $fileName;
                /** 文件存储绝对路径(包含文件名) */
                $newArr['savePath'] = str_replace('\\', '/', $savePath . '/' . $fileName);

                /** 需要进行一个替换不然实现不了 */
                $search=str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);

                /**  文件访问URL地址 */
                $newArr['url'] = str_replace($search, $this->host, $newArr['savePath']);
                /** 文件访问URI相对地址 */
                $newArr['uri'] = str_replace($search, '', $newArr['savePath']);
                /** 文件MD5  */
                $newArr['md5'] = md5_file($newArr['savePath']);
            }

            return array(
                'status' => true,
                'msg' => "上传成功",
                'data'=>$newArr
            );
        } else {
            return array(
                'status' => false,
                "msg" => "提交上传的文件为空"
            );
        }
    }


    /**
     * 过滤允许设置
     * 过滤允许规则 ['ext'=>'后缀名限制','size'=>193038] = ['ext'=>'png,jpg,gif','size'=>193038]
     * @param array $allow
     * @return $this
     */
    private function allow(array $allow): Upload
    {
        if ($allow != "") {
            /** 文件格式过滤 - 文件后缀 */
            if (isset($allow['ext']) && !empty($allow['ext'])) {
                if (is_array($allow['ext'])) {
                    $this->ext = $allow['ext'];
                } else {
                    $this->ext = explode(',', $allow['ext']);
                }
            }

            /** 文件格式过滤 - MIME */
            if (isset($allow['mime']) && !empty($allow['mime'])) {
                if (is_array($allow['mime'])) {
                    $this->mime = $allow['mime'];
                } else {
                    $this->mime = explode(',', $allow['mime']);
                }
            }

            /** 文件大小过滤 */
            if (isset($allow['size']) && !empty($allow['size'])) {
                $this->size = (int)$allow['size'];
            }
        }
        return $this;
    }

    /**
     * 文件校检
     * @param array $file
     * @return array
     */
    private function fileCheck(array $file): array
    {
        /** 上传文件是否存在失败 */
        if ($file['error'] !== 0) {
            return array(
                'status' => false,
                'msg' => "上传文件失败"
            );
        }

        /** 上传文件是否存在不合法的格式文件 */
        if ($this->ext != NULL || $this->mime != NULL) {
            if (@!(in_array($this->getFileExt($file['name']), $this->ext) || in_array($file['type'], $this->mime))) {
                return array(
                    'status' => false,
                    'msg' => "上传文件不合法,格式不对"
                );
            }
        }

        /** 上传文件的大小不符合规定的大小 */
        if ($this->size != NULL) {
            if ($file['size'] > $this->size) {
                return array(
                    'status' => false,
                    'msg' => "上传文件太大，上传失败"
                );
            }
        }

        return array(
            'status' => true,
            'msg' => "文件上传成功"
        );
    }

    /**
     * 获取文件后缀名
     * @param String $file 文件名
     * @return String
     */
    private function getFileExt(string $file): string
    {
        /** 计算文件最后一次出现的取得文件后缀名 */
        $rOffset = strrpos($file, '.');
        if ($rOffset) {
            $ext = substr($file, $rOffset + 1);
        } else {
            $ext = '';
        }

        return $ext;
    }

    /**
     * 文件唯一名称生成 时间＋6位随机数
     * @return String
     */
    private function uuid(): string
    {
        /** 时间＋6位随机数 */
        return time() . mt_rand(100000, 999999);
    }


}