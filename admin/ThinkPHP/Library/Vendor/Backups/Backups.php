<?php

class Backups
{
    public $db;
    public $host;    //数据库地址
    public $user;    //登录名
    public $pwd;    //密码
    public $dbname;    //数据库名
    public $charset;    //数据库连接编码
    public $dsn;
    public $con;
    public $header;//数据表的开头

    public function __construct($host, $user, $psw, $dbname, $header = "", $db = "mysql", $charset = "utf8")
    {
        $this->db = $db;
        $this->host = $host;
        $this->user = $user;
        $this->pwd = $psw;
        $this->dbname = $dbname;
        $this->charset = $charset;
        $this->header = $header;
        $this->dsn = "$db:host=$host;dbname=$dbname";
        $this->con = $this->db();
    }

    /**
     * 备份 ...
     * @param $filename 文件路径
     */
    function beifen($dir, $tables = '', $size = 1)
    {
        $dir != "" or exit("目录不能为空");
        $this->dir_create($dir);
        $dir = $this->dir_path($dir);
        $tables = empty($tables) ? $this->tables_list() : $tables;
        return $this->tables_backups($dir, $tables, $size);
    }

    /**
     * 还原 ...
     * @param $filename 文件路径
     */
    function restore($filename)
    {
        //执行SQL
        is_array($filename) or exit("不是数组");
        foreach ($filename as $vo) {
            is_file($vo) or exit("不是文件或文件不存在");
            $str = file_get_contents($vo);
            $arr = explode('-- <xjx> --', $str);
            array_pop($arr);

            foreach ($arr as $v) {
                $rs = $this->con->query($v);

                if (strpos($v, "INSERT INTO") and !$rs->rowCount()) {
                    return 0;
                }
            }
        }
        return 1;
    }


    /**
     * 所有的表名
     */
    function tables_list()
    {
        $rs = $this->con->query("SHOW TABLES FROM $this->dbname");
        foreach ($rs->fetchAll() as $vo) {
            if ($this->header != '' and $this->str($vo[0]) != $this->header) {
                continue;
            }
            $row[] = $vo[0];
        }
        return $row;
    }

    /**
     * 行数
     */
    function tables_list_count()
    {
        $array = array();
        foreach ($this->tables_list() as $k => $vo) {
            $rs = $this->con->query("select count(*) from $vo");
            $count = $rs->fetch();
            $array[$k]["count"] = $count[0];
            $array[$k]["table"] = $vo;
        }
        return $array;
    }

    /**
     * 数据写入文件
     */
    function tables_backups($dir, $tables, $size = 1)
    {
        $this->showMsghreder();
        $sql = $this->header(time());
        $kkkk = 1;
        $filename = $this->create_randomstr();
        $this->showMsg("开始备份数据···");
        foreach ($tables as $v) {
            /*********得到结构***********/
            $rs = $this->con->query("SHOW CREATE TABLE $v");
            $temp = $rs->fetch();
            $sql .= "-- ->>>{$temp[0]}<<<- --\n";
            $sql .= "-- 表的结构：{$temp[0]} --\n";
            $sql .= "DROP TABLE IF EXISTS {$temp[0]};-- <xjx> --\n";
            $sql .= "{$temp[1]}";
            $sql .= ";-- <xjx> --\n";
            /*********得到数据***********/
            $rs2 = $this->con->query("SELECT * FROM $v");
            if (!$rs2->rowCount()) {//无数据返回
                continue;
            }
            $sql .= "-- 表的数据：$v --\r\n";
            foreach ($rs2->fetchAll() as $tem) {
                if (strlen($sql) >= $size * 1024 * 1024) {
                    $time = time();
                    file_put_contents("{$dir}{$filename}_db_" . date("Ymdhis", $time) . "_v{$kkkk}.sql", $sql);
                    $this->showMsg("卷{$kkkk}备份成功···");
                    $kkkk++;
                    $sql = $this->header($time);
                }
                $sql .= "INSERT INTO `$v` VALUES";
                $sql .= '(';
                foreach ($tem as $k => $v2) {
                    if (!is_numeric($k)) continue;
                    if ($v2 === null) {
                        $sql .= "NULL,";
                    } else {
                        $sql .= "'" . trim($v2) . "',";
                    }
                }
                $sql = mb_substr($sql, 0, -1);
                $sql .= ");\n";
            }
            unset($rs2, $rs);
            $sql = mb_substr($sql, 0, -3);
            $sql .= ");-- <xjx> --\r\n";
        }
        if ($sql != '') {
            $time = time();
            file_put_contents("{$dir}{$filename}_db_" . date("Ymdhis", $time) . "_v{$kkkk}.sql", $sql);
            $this->showMsg("卷{$kkkk}备份成功···");
        }
        $this->showMsg("备份成功···");
        return $filename;
    }

    /**
     * 连接数据库
     */
    function  db()
    {
        try {
            $con = new PDO($this->dsn, $this->user, $this->pwd);
            $con->query("SET NAMES '{$this->charset}'");
            return $con;
        } catch (Exception $e) {
            die("链接失败" . $e->getMessage());
        }
    }

    /**
     * 匹配表头
     */
    public function str($str)
    {
        return substr($str, 0, strpos($str, "_"));
    }

    /**
     * 获取表
     */
    function  sql_tables($filename)
    {
        $nei = file_get_contents($filename);
        $pre = "#-- 表的结构：(.*) --#iUs";
        preg_match_all($pre, $nei, $arr);
        return $arr[1];
    }

    /**
     * 备份进度提示
     */
    private function showMsghreder($msgTitle = "数据备份")
    {
        $str = '<!DOCTYPE HTML>';
        $str .= '<html>';
        $str .= '<head>';
        $str .= '<meta charset="utf-8">';
        $str .= '<title>页面提示</title>';
        $str .= '<style type="text/css">';
        $str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message:hover{box-shadow: 2px 1px 8px 3px #aaa;border:1px solid #aaa}.message{width:450px; height:120px; margin:16% auto; border:1px solid #ccc; background:#ffff;box-shadow: 0px 5px 9px 1px #999;}.message h3{height:35px; line-height:35px; background:#3073AC; text-align:center; color:#fff; font-size:15px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:35px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt center{line-height:35px;font-size:15px}';
        $str .= '</style>';
        $str .= '</head>';
        $str .= '<body>';
        $str .= '<div class="message"style="background-color: #ffffff">';
        $str .= '<h3>' . $msgTitle . '</h3>';
        $str .= '<div class="msg_txt"style="text-align: center">';
        $str .= "<center id='message'></center>";
        $str .= '</div>';
        $str .= '</div>';
        $str .= '</body>';
        $str .= '</html>';
        echo $str;
    }

    /**
     * 刷新缓存区
     */
    private function showMsg($msg)
    {
        ob_start();
        echo "<script>document.getElementById('message').innerHTML='{$msg}'</script>";
        ob_flush();
        flush();
    }

    function create_randomstr($lenth = 6)
    {
        return $this->random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
    }

    function random($length, $chars = '0123456789')
    {
        $hash = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    /**
     * 备份信息
     */
    private function header($date)
    {
        $version = $this->con->query("select version()")->fetch();
        $name = "/******************************************\n";
        $name .= "*主机名      :$this->host\n";
        $name .= "*数据库      :$this->dbname\n";
        $name .= "*备份日期    :" . date("Y-m-d h:i:s", $date) . "\n";
        $name .= "*mysql版本   :{$version[0]}\n";
        $name .= "*php版本     :" . phpversion() . "\n";
        $name .= "******************************************/\n";
        return $name;
    }

    /**
     * 创建目录
     */
    public function dir_create($path)
    {
        if (is_dir($path)) return TRUE;
        mkdir($path);
        return is_dir($path);
    }

    /**
     * 转化 \ 为 /
     *
     * @param    string $path 路径
     * @return    string    路径
     */
    private function dir_path($path)
    {
        $path = str_replace('\\', '/', $path);
        if (substr($path, -1) != '/') $path = $path . '/';
        return $path;
    }
}