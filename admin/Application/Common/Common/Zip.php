<?php
/*
 * 压缩文件或文件夹
 * @filename    压缩包名称
 * @sourcename 文件或目录名称
*/
function yasuo($sourcename, $filename = '')
{
    $filename = $filename == "" ? uniqid() : $filename;
    $zip = new \ZipArchive;
    if ($zip->open($filename . '.zip', \ZipArchive::OVERWRITE) === TRUE) {
        if (is_file($sourcename)) {
            $zip->addFile($sourcename);
        } else if (is_dir($sourcename)) {
            foreach (dir_list($sourcename) as $vo) {
                $zip->addFile($vo);//
            }
        } else {
            return 0;
        }
        $zip->close();
    }
    return 1;
}

/*
 * 解压文件
 * @filename  压缩包名称
 * @dir       解压目录默认当前目录
 */
function jieya($filename, $dir = "./")
{
    dir_create($dir) or exit("目录创建失败");
    $zip = new \ZipArchive;//新建一个ZipArchive的对象
    if ($zip->open($filename) === TRUE) {
        $zip->extractTo($dir);
        $zip->close();
        return 1;
    } else {
        return 0;
    }
}

/*
 * 追加文件到压缩包
 * @addfilename  追加文件
 * @tofilename   源文件
 */
function addtozip($addfilename, $tofilename)
{
    is_file($addfilename) or exit("追加文件不存在");
    is_file($tofilename) or exit("源文件不存在");
    $zip = new \ZipArchive;
    $res = $zip->open($tofilename, \ZipArchive::CREATE);
    if ($res === TRUE) {
        $zip->addFile($addfilename);
        $zip->close();
        return 1;
    } else {
        return 0;
    }
}

/*
 * 追加不存在文件到压缩包或改变压缩包里文件内容
 * @addfilename 追加的文件名称
 * @text        追加的文件的内容
 * @tofilename  压缩包的内容
 */
function addtexttozip($addfilename, $text, $tofilename)
{
    is_file($tofilename) or exit("源文件不存在");
    $zip = new \ZipArchive;
    $res = $zip->open($tofilename, \ZipArchive::CREATE);
    if ($res === TRUE) {
        $zip->addFromString($addfilename, $text);
        $zip->close();
        return 1;
    } else {
        return 0;
    }
}

/*
 * 读取压缩包里所有文件及文件夹
 * @filename  压缩包名称
 * $statue    是否读取文件内容0否 1是
 */
function readzip($filename, $statue = 0)
{
    $zip = zip_open($filename);
    $num = 0;
    $array = array();
    while ($entry = zip_read($zip)) {
        $array[$num]["name"] = zip_entry_name($entry);
        $array[$num]["filesize"] = zip_entry_filesize($entry);
        $array[$num]["compressedsize"] = zip_entry_compressedsize($entry);
        $array[$num]["compressionmethod"] = zip_entry_compressionmethod($entry);
        if ($statue == 1) {
            if (zip_entry_open($zip, $entry, "r")) {
                $buf = zip_entry_read($entry, zip_entry_filesize($entry));
                $array[$num]["content"] = $buf;
                zip_entry_close($entry);
            }
        }
        $num++;
    }
    zip_close($zip);
    return $array;
}