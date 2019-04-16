<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5
 * Time: 16:36
 */

if (! function_exists('make_username')) {
    /**
     * 生成用户名
     *
     * @param int $length
     * @param bool $prefix
     * @return string
     */
    function make_username($length=19,$prefix=false)
    {
        return $prefix ? : 'Spen_' . str_random($length);
    }
}

if (! function_exists('admin_asset')) {
    /**
     * 后台资源路径
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function admin_asset($path, $secure = null)
    {
        $path = 'static/admin/' . $path;
        return app('url')->asset($path, $secure);
    }
}

//配合下面方法用   不需直接调用
function make_tree($arr) {
    if (!function_exists('make_tree1')) {

        function make_tree1($arr, $parent_id = 0) {
            $new_arr = array();
            foreach ($arr as $k => $v) {
                if ($v['pid'] == $parent_id) {
                    $new_arr[] = $v;
                    unset($arr[$k]);
                }
            }
            foreach ($new_arr as &$a) {
                $a['children'] = make_tree1($arr, $a['id']);
            }
            return $new_arr;
        }

    }
    return make_tree1($arr);
}

/**
 * 生成带前缀的树状结构数据
 *
 * @param $arr
 * @return array
 */
function make_tree_with_name_pre($arr) {
    $arr = make_tree($arr);

    if (!function_exists('makeTreeWithNamePre')) {
        function makeTreeWithNamePre($arr, $prestr = '') {
            $new_arr = array();
            foreach ($arr as $v) {
                if ($prestr) {
                    if ($v == end($arr)) {
                        $v->name = $prestr . '└─ ' . $v->name;
                    } else {
                        $v->name = $prestr . '├─ ' . $v->name;
                    }
                }

                if ($prestr == '') {
                    $prestr_for_children = '&nbsp;&nbsp;';
                } else {
                    if ($v == end($arr)) {
                        $prestr_for_children = $prestr . '&nbsp;&nbsp;&nbsp;&nbsp;';
                    } else {
                        $prestr_for_children = $prestr . '│ ';
                    }
                }
                $v->children = makeTreeWithNamePre($v->children, $prestr_for_children);

                $new_arr[] = $v;
            }
            return $new_arr;
        }
    }
    return makeTreeWithNamePre($arr);
}

/**
 * 变成树状结构数组
 *
 * @param $arr
 * @return array
 */
function make_tree_to_array($arr) {
    $tree = make_tree_with_name_pre($arr);

    if (!function_exists('makeTreeToArray')) {
        function makeTreeToArray($tree){
            static $new_tree = [];
            foreach ($tree as $key=>$val){
                if (isset($val['children']) && $val['children']){
                    $children = $val['children'];
                    unset($val['children']);
                    $new_tree[] = $val;
                    makeTreeToArray($children);
                }else{
                    $new_tree[] = $val;
                }
            }
            return $new_tree;
        }
    }
    return makeTreeToArray($tree);
}

//配合下面方法用   不需直接调用
function make_tree_with_namepre($arr) {
    $arr = make_tree($arr);
    if (!function_exists('add_namepre1')) {

        function add_namepre1($arr, $prestr = '') {
            $new_arr = array();
            foreach ($arr as $v) {
                if ($prestr) {
                    if ($v == end($arr)) {
                        $v->name = $prestr . '└─ ' . $v->name;
                    } else {
                        $v->name = $prestr . '├─ ' . $v->name;
                    }
                }

                if ($prestr == '') {
                    $prestr_for_children = '&nbsp;&nbsp;';
                } else {
                    if ($v == end($arr)) {
                        $prestr_for_children = $prestr . '&nbsp;&nbsp;&nbsp;&nbsp;';
                    } else {
                        $prestr_for_children = $prestr . '│ ';
                    }
                }
                $v->children = add_namepre1($v->children, $prestr_for_children);

                $new_arr[] = $v;
            }
            return $new_arr;
        }

    }
    return add_namepre1($arr);
}

/* * 无限分类的下拉框表示
 * @param $arr  数据源  这里是对象类型
 * @param int $depth，当$depth为0的时候表示不限制深度
 * @return string
 * default  默认选择的id
 */

function make_option_tree_for_select($arr, $default, $depth = 0) {
    $arr = make_tree_with_namepre($arr);
    if (!function_exists('make_options1')) {

        function make_options1($arr, $default, $depth, $recursion_count = 0, $ancestor_ids = '') {
            $recursion_count++;
            $str = '';
            foreach ($arr as $v) {
                $value = "";
                if ($v->id == $default) {
                    $value = "selected=selected";
                }
                $str .= "<option value='{$v->id}' data-depth='{$recursion_count}' data-ancestor_ids='" . ltrim($ancestor_ids, ',') . "' {$value}>{$v->name}</option>";
                if ($v->pid == 0) {
                    $recursion_count = 1;
                }
                if ($depth == 0 || $recursion_count < $depth) {
                    $str .= make_options1($v->children,$default, $depth, $recursion_count, $ancestor_ids . ',' . $v->id);
                }
            }
            return $str;
        }

    }
    return make_options1($arr, $default, $depth);
}

/**
 * 生成导航
 * @param $arr
 * @param $default
 * @param $pid
 * @param int $depth
 * @return string
 */
function make_li_tree_for_ul($arr, $default,$pid, $depth = 0)
{
    $arr = make_tree($arr);
    if(!function_exists('make_li')){
        function make_li($arr,$default,$pids)
        {
            $html = '';
            foreach($arr as $t)
            {
                if(!$t['is_nav']){
                    continue;
                }
                $active = '';
                if($default == $t['id']){
                    $active = 'active';
                }elseif(in_array($t['id'],$pids)){
                    $active = 'active menu-open';
                }

                $href = '';
                if($t['route']){
                    $href = route($t['route']);
                }

                if(empty($t['children'])){
                    $html .= '<li class="' . $active . '"><a href="' . $href . '"><i class="fa ' . $t['icon'] . '"></i><span>' . $t['name'] . '</span></a></li>';
                }else{

                    if(in_array($t['id'],$pids)){
                        $active = 'active menu-open';
                    }
                    $html .= '<li class="treeview ' . $active . '"><a href="' . $href . '"><i class="fa ' . $t['icon'] . '"></i> <span>' . $t['name'] . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                    $html .= make_li($t['children'],$default,$pids);
                    $html = $html.'</li>';
                }
            }
            return $html ? '<ul class="treeview-menu">'.$html.'</ul>' : $html ;
        }
    }
    return make_li($arr,$default,$pid);
}


if (!function_exists('is_assoc')){
    /**
     * 判断是否为索引数组
     *
     * @param $arr
     * @return bool
     */
    function is_assoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}

/**
 * 生成导航
 *
 * @param $arr
 * @return string
 */
function make_menu($arr)
{
    $arr = make_tree($arr);

    if (!function_exists('treeToArray')) {
        function makeLeftMenu($arr){
            $html = '';
            foreach ($arr as $val){

                try{
                    $href= route($val['name']);
                }catch (Exception $e){
                    $href = url($val['url']??'/');
                }

                if(empty($val['children'])){
                    $html .= '<li class="left-nav-li" id="left-nav-'.$val['id'].'"><a href="'. $href .'"><i class="fa ' . $val["icon"] . '"></i><span> '.$val["title"].' </span></a></li>';
                }else{
                    $html .= '<li class="treeview"><a href="' . $href . '"><i class="fa ' . $val["icon"] . '"></i> <span>' . $val['title'] . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                    $html .= '<ul class="treeview-menu">';
                    $html .= makeLeftMenu($val['children']);
                    $html .= '</ul>';
                    $html .= '</li>';
                }
            }
            return $html; //? '<ul class="treeview-menu">'.$html.'</ul>' : $html ;
        }

    }
    return makeLeftMenu($arr);
}

if (! function_exists('success')) {
    /**
     * 成功提示页面
     *
     * @param $message
     * @param bool $url
     * @param int $expire
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function success($message,$url=false,$expire=3)
    {
        $message = [$message,$expire * 1000];
        if($url){
            return redirect($url)->withErrors($message, 'success');
        }else{
            return back()->withErrors($message, 'success');
        }
    }
}

if (! function_exists('error')) {
    /**
     * 失败提示页面
     *
     * @param $url
     * @param bool $message
     * @param int $time
     * @return \Illuminate\Http\RedirectResponse
     */
    function error($message,$url=false,$expire=3)
    {
        $message = [$message,$expire * 1000];
        if($url){
            return redirect($url)->withErrors($message, 'error');
        }else{
            return back()->withErrors($message, 'error');
        }
    }
}

if (! function_exists('getPids')) {
    /**
     * 失败提示页面
     *
     * @param $url
     * @param bool $message
     * @param int $time
     * @return \Illuminate\Http\RedirectResponse
     */
    function getPids($pid,&$pids)
    {
        $pids = $pids?:[];
        $permission = \App\Models\Permission::where('id',$pid)->first();
        $pids[] = $permission['id'];
        if($permission['pid'] != 0){
            getPids($permission['pid'],$pids);
        }
        return $permission['id'];
    }
}

if (!function_exists('sld'))
{
    /**
     * 获取二级域名（子域名）
     *
     * @return mixed
     */
    function sld(){

        preg_match("#(http|https)://(.*?)\.#i",request()->url(),$match);

        return $match[2]??'';
    }
}

if (!function_exists('img_path')){
    /**
     * 获取图片路径
     *
     * @param bool $source
     * @return \Illuminate\Config\Repository|mixed
     */
    function img_path($source=false)
    {
        switch ($source){
            case 'local':
                return config('filesystems.disks.local.url') . '/';
                break;
            case 'qiniu':
                return config('filesystems.disks.qiniu.domain') . '/';
                break;
            default:
                return config('filesystems.disks.local.url') . '/';
                break;
        }
    }
}

if (!function_exists('file_format')) {
    /**
     * 获取文件格式
     *
     * @param $str
     * @return string
     */
    function file_format($str)
    {
        // 取文件后缀名
        $str = strtolower(pathinfo($str, PATHINFO_EXTENSION));
        // 图片格式
        $image = array('webp', 'jpg', 'png', 'ico', 'bmp', 'gif', 'tif', 'pcx', 'tga', 'bmp', 'pxc', 'tiff', 'jpeg', 'exif', 'fpx', 'svg', 'psd', 'cdr', 'pcd', 'dxf', 'ufo', 'eps', 'ai', 'hdri');
        // 音频格式
        $audio = array('mp3');
        // 视频格式
        $video = array('mp4', 'avi', '3gp', 'rmvb', 'gif', 'wmv', 'mkv', 'mpg', 'vob', 'mov', 'flv', 'swf', 'ape', 'wma', 'aac', 'mmf', 'amr', 'm4a', 'm4r', 'ogg', 'wav', 'wavpack');
        // 压缩格式
        $zip = array('rar', 'zip', 'tar', 'cab', 'uue', 'jar', 'iso', 'z', '7-zip', 'ace', 'lzh', 'arj', 'gzip', 'bz2', 'tz');
        // Pdf格式
        $pdf = array('pdf');
        // 文档格式
        $text = array('exe', 'doc', 'ppt', 'xls', 'wps', 'txt', 'lrc', 'wfs', 'torrent', 'html', 'htm', 'java', 'js', 'css', 'less', 'php', 'pps', 'host', 'box', 'docx', 'word', 'perfect', 'dot', 'dsf', 'efe', 'ini', 'json', 'lnk', 'log', 'msi', 'ost', 'pcs', 'tmp', 'xlsb');
        // 匹配不同的结果
        switch ($str) {
            case in_array($str, $image):
                return 'image';
                break;
            case in_array($str, $audio):
                return 'audio';
                break;
            case in_array($str, $video):
                return 'video';
                break;
            case in_array($str, $zip):
                return 'zip';
                break;
            case in_array($str, $pdf):
                return 'pdf';
                break;
            case in_array($str, $text):
                return 'text';
                break;
            default:
                return false;
                break;
        }
    }
}
