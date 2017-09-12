<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use COM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view('admin.system.index');
    }

    public function user($id)
    {
        $id = intval($id);
        $user = User::where('id', $id)->first();
        return view('admin.user.index', compact('user'));
    }

    public function systeminfo()
    {
        $data = [];
        $data['RAM'] = [];
        $data['Disk'] = [];
        $data['SWAP'] = [];
        $data['CPU'] = [];

//        $xx = $this->sys_windows();
//        echo $xx;
//        $data['xx'] = $xx;
        $data['RAM']['current'] = 4098;
        $data['RAM']['all'] = 8123;
        $data['RAM']['state'] = 0;
        $data['CPU']['current'] = 4098;
        $data['CPU']['all'] = 8123;
        $data['CPU']['state'] = 0;
        $data['Disk']['current'] = 513432;
        $data['Disk']['all'] = 1001200;
        $data['Disk']['state'] = 0;
        $data['SWAP']['current'] = 1024;
        $data['SWAP']['all'] = 2048;
        $data['SWAP']['state'] = 0;
        return json_encode($data);
    }

    public function sys_linux() {
        $fp = popen('top -b -n 2 | grep -E "^(Cpu|Mem|Tasks)"',"r");//获取某一时刻系统cpu和内存使用情况
        $rs = "";
        while(!feof($fp)){
            $rs .= fread($fp,1024);
        }
        pclose($fp);
        $sys_info = explode("\n",$rs);
        $tast_info = explode(",",$sys_info[3]);//进程 数组
        $cpu_info = explode(",",$sys_info[4]);  //CPU占有量  数组
        $mem_info = explode(",",$sys_info[5]); //内存占有量 数组
        //正在运行的进程数
        $tast_running = trim(trim($tast_info[1],'running'));


        //CPU占有量
        $cpu_usage = trim(trim($cpu_info[0],'Cpu(s): '),'%us');  //百分比

        //内存占有量
        $mem_total = trim(trim($mem_info[0],'Mem: '),'k total');
        $mem_used = trim($mem_info[1],'k used');
        $mem_usage = round(100*intval($mem_used)/intval($mem_total),2);  //百分比

        /*硬盘使用率 begin*/
        $fp = popen('df -lh | grep -E "^(/)"',"r");
        $rs = fread($fp,1024);
        pclose($fp);
        $rs = preg_replace("/\s{2,}/",' ',$rs);  //把多个空格换成 “_”
        $hd = explode(" ",$rs);
        $hd_avail = trim($hd[3],'G'); //磁盘可用空间大小 单位G
        $hd_usage = trim($hd[4],'%'); //挂载点 百分比
        //print_r($hd);
        /*硬盘使用率 end*/

        //检测时间
        $fp = popen("date +\"%Y-%m-%d %H:%M\"","r");
        $rs = fread($fp,1024);
        pclose($fp);
        $detection_time = trim($rs);
    }

    public function sys_windows() {
        $objLocator = new COM("WbemScripting.SWbemLocator");
        $wmi = $objLocator->ConnectServer();
        $prop = $wmi->get("Win32_PnPEntity");
//CPU
        $cpuinfo = $this->GetWMI($wmi,"Win32_Processor", array("Name","L2CacheSize","NumberOfCores"));
        $res['CPU个数'] = $cpuinfo[0]['NumberOfCores'];
        if (null == $res['CPU个数']) {
            $res['CPU个数'] = 1;
        }
        for ($i=0;$i<$res['cpu']['num'];$i++){
            $res['CPU型号'] .= $cpuinfo[0]['Name']."<br>";
            $res['二级缓存'] .= $cpuinfo[0]['L2CacheSize']."<br>";
        }
// SYSINFO
        $sysinfo = $this->GetWMI($wmi,"Win32_OperatingSystem", array('LastBootUpTime','TotalVisibleMemorySize','FreePhysicalMemory','Caption','CSDVersion','SerialNumber','InstallDate'));
        $res['操作系统版本'] = $sysinfo[0]['Caption']." ".$sysinfo[0]['CSDVersion'];
        $res['操作系统序列号'] = "{$sysinfo[0]['SerialNumber']} 于".date('Y年m月d日H:i:s',strtotime(substr($sysinfo[0]['InstallDate'],0,14)))."安装";
//UPTIME
        $res['最后重启时间'] = $sysinfo[0]['LastBootUpTime'];


        $sys_ticks = 3600*8 + time() - strtotime(substr($res['最后重启时间'],0,14));
        $min = $sys_ticks / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        if ($days !== 0) $ress['day'] = $days."天";
        if ($hours !== 0) $ress['hours'] .= $hours."小时";
        $res['最后重启时间'] = $ress['day'].$ress['hours'].$min."分钟";

//MEMORY
        $res['物理内存'] = $sysinfo[0]['TotalVisibleMemorySize'];
        $res['剩余内存'] = $sysinfo[0]['FreePhysicalMemory'];
        $res['已使用内存'] = $res['物理内存'] - $res['剩余内存'];
        $res['使用率'] = round($res['已使用内存'] / $res['物理内存']*100,2);

        $swapinfo = $this->GetWMI($wmi,"Win32_PageFileUsage", array('AllocatedBaseSize','CurrentUsage'));

// TODO swp区获取
        $res['交换分区'] = $swapinfo[0][AllocatedBaseSize];
        $res['已经使用'] = $swapinfo[0][CurrentUsage];
        $res['剩余内存'] = $res['swapTotal'] - $res['swapUsed'];
        $res['使用率'] = (floatval($res['swapTotal'])!=0)?round($res['swapUsed']/$res['swapTotal']*100,2):0;

// LoadPercentage
        $loadinfo = $this->GetWMI($wmi,"Win32_Processor", array("LoadPercentage"));
        $res['系统平均负载'] = $loadinfo[0]['LoadPercentage'];

        return $res;
    }

    public function GetWMI($wmi,$strClass, $strValue = array()) {
        $arrData = array();

        $objWEBM = $wmi->Get($strClass);
        $arrProp = $objWEBM->Properties_;
        $arrWEBMCol = $objWEBM->Instances_();
        foreach($arrWEBMCol as $objItem) {
            @reset($arrProp);
            $arrInstance = array();
            foreach($arrProp as $propItem) {
                eval("\$value = \$objItem->" . $propItem->Name . ";");
                if (empty($strValue)) {
                    $arrInstance[$propItem->Name] = trim($value);
                } else {
                    if (in_array($propItem->Name, $strValue)) {
                        $arrInstance[$propItem->Name] = trim($value);
                    }
                }
            }
            $arrData[] = $arrInstance;
        }
        return $arrData;
    }
}
